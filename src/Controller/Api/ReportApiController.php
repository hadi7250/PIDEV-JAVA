<?php

namespace App\Controller\Api;

use App\Entity\ForumReport;
use App\Entity\ForumDiscussion;
use App\Entity\ForumMessage;
use App\Repository\ForumReportRepository;
use App\Repository\ForumDiscussionRepository;
use App\Repository\ForumMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api')]
class ReportApiController extends AbstractController
{
    #[Route('/reports', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function listReports(
        Request $request,
        ForumReportRepository $reportRepository
    ): JsonResponse {
        $status = $request->query->get('status');
        $type = $request->query->get('type');

        if ($status) {
            $reports = $reportRepository->findByStatus($status);
        } else {
            $reports = $reportRepository->findAll();
        }

        $data = [];
        foreach ($reports as $report) {
            if ($type && $report->getType() !== $type) {
                continue;
            }
            $data[] = $this->serializeReport($report);
        }

        return $this->json([
            'reports' => $data,
            'total' => count($data),
            'pendingCount' => $reportRepository->countPending()
        ]);
    }

    #[Route('/reports', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function createReport(
        Request $request,
        ForumDiscussionRepository $discussionRepository,
        ForumMessageRepository $messageRepository,
        ForumReportRepository $reportRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->getUser();
        $type = $data['type'] ?? null;
        $reason = $data['reason'] ?? null;
        $description = $data['description'] ?? null;
        $discussionId = $data['discussionId'] ?? null;
        $messageId = $data['messageId'] ?? null;

        // Validate type
        if (!in_array($type, [ForumReport::TYPE_DISCUSSION, ForumReport::TYPE_MESSAGE])) {
            return $this->json(['error' => 'Invalid report type. Use DISCUSSION or MESSAGE'], Response::HTTP_BAD_REQUEST);
        }

        // Validate reason
        if (empty($reason)) {
            return $this->json(['error' => 'Reason is required'], Response::HTTP_BAD_REQUEST);
        }

        $report = new ForumReport();
        $report->setReporter($user);
        $report->setType($type);
        $report->setReason($reason);
        $report->setDescription($description);

        if ($type === ForumReport::TYPE_DISCUSSION) {
            if (!$discussionId) {
                return $this->json(['error' => 'discussionId is required for discussion reports'], Response::HTTP_BAD_REQUEST);
            }
            $discussion = $discussionRepository->find($discussionId);
            if (!$discussion) {
                return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
            }
            // Check if already reported by this user
            if ($reportRepository->hasUserReportedDiscussion($user, $discussionId)) {
                return $this->json(['error' => 'You have already reported this discussion'], Response::HTTP_CONFLICT);
            }
            $report->setDiscussion($discussion);
        } else {
            if (!$messageId) {
                return $this->json(['error' => 'messageId is required for message reports'], Response::HTTP_BAD_REQUEST);
            }
            $message = $messageRepository->find($messageId);
            if (!$message) {
                return $this->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
            }
            // Check if already reported by this user
            if ($reportRepository->hasUserReportedMessage($user, $messageId)) {
                return $this->json(['error' => 'You have already reported this message'], Response::HTTP_CONFLICT);
            }
            $report->setMessage($message);
        }

        $entityManager->persist($report);
        $entityManager->flush();

        return $this->json([
            'report' => $this->serializeReport($report),
            'message' => 'Report submitted successfully'
        ], Response::HTTP_CREATED);
    }

    #[Route('/reports/{id}/status', methods: ['PUT'])]
    #[IsGranted('ROLE_ADMIN')]
    public function updateReportStatus(
        int $id,
        Request $request,
        ForumReportRepository $reportRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $report = $reportRepository->find($id);

        if (!$report) {
            return $this->json(['error' => 'Report not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $status = $data['status'] ?? null;

        if (!in_array($status, [ForumReport::STATUS_PENDING, ForumReport::STATUS_REVIEWED, ForumReport::STATUS_RESOLVED, ForumReport::STATUS_DISMISSED])) {
            return $this->json(['error' => 'Invalid status. Use PENDING, REVIEWED, RESOLVED, or DISMISSED'], Response::HTTP_BAD_REQUEST);
        }

        $report->setStatus($status);
        
        if (in_array($status, [ForumReport::STATUS_RESOLVED, ForumReport::STATUS_DISMISSED])) {
            $report->setResolvedBy($this->getUser());
            $report->setResolvedAt(new \DateTime());
        }

        $entityManager->flush();

        return $this->json([
            'report' => $this->serializeReport($report),
            'message' => 'Report status updated successfully'
        ]);
    }

    private function serializeReport(ForumReport $report): array
    {
        $target = null;
        if ($report->getType() === ForumReport::TYPE_DISCUSSION && $report->getDiscussion()) {
            $target = [
                'id' => $report->getDiscussion()->getId(),
                'type' => 'discussion',
                'title' => $report->getDiscussion()->getTitle(),
            ];
        } elseif ($report->getType() === ForumReport::TYPE_MESSAGE && $report->getMessage()) {
            $target = [
                'id' => $report->getMessage()->getId(),
                'type' => 'message',
                'content' => substr($report->getMessage()->getContent() ?? '', 0, 100),
            ];
        }

        $reporterName = $report->getReporter() 
            ? trim($report->getReporter()->getFirstName() . ' ' . $report->getReporter()->getLastName())
            : null;
        $resolvedByName = $report->getResolvedBy()
            ? trim($report->getResolvedBy()->getFirstName() . ' ' . $report->getResolvedBy()->getLastName())
            : null;

        return [
            'id' => $report->getId(),
            'reporter' => [
                'id' => $report->getReporter()?->getId(),
                'name' => $reporterName,
            ],
            'type' => $report->getType(),
            'reason' => $report->getReason(),
            'description' => $report->getDescription(),
            'status' => $report->getStatus(),
            'target' => $target,
            'createdAt' => $report->getCreatedAt()?->format('c'),
            'resolvedAt' => $report->getResolvedAt()?->format('c'),
            'resolvedBy' => $report->getResolvedBy() ? [
                'id' => $report->getResolvedBy()->getId(),
                'name' => $resolvedByName,
            ] : null,
        ];
    }
}
