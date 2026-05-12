<?php



namespace App\Controller;



use App\Entity\User;

use App\Form\UserType;

use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Http\Attribute\IsGranted;

use Symfony\Component\String\Slugger\SluggerInterface;



class DashboardController extends AbstractController

{

    #[Route('/dashboard', name: 'dashboard_index')]

    #[IsGranted('ROLE_ADMIN')]

    public function dashboardIndex(UserRepository $userRepository): Response

    {

        $stats = [

            'total_users' => $userRepository->count([]),

            'students' => count($userRepository->findByRole('ROLE_STUDENT')),

            'enseignants' => count($userRepository->findByRole('ROLE_ENSEIGNANT')),

            'admins' => count($userRepository->findByRole('ROLE_ADMIN')),

        ];

        

        return $this->render('dashboard/index.html.twig', [

            'stats' => $stats,

            'user' => $this->getUser(),

        ]);

    }



    #[Route('/dashboard/users/add', name: 'dashboard_users_add')]

    #[IsGranted('ROLE_ADMIN')]

    public function usersAdd(UserRepository $userRepository): Response

    {

        $users = $userRepository->findAll();

        

        // Serialize users to array to prevent undefined values

        $usersArray = [];

        foreach ($users as $user) {

            $usersArray[] = [

                'id' => $user->getId(),

                'name' => $user->getFirstName() . ' ' . $user->getLastName(),

                'email' => $user->getEmail(),


                'roles' => $user->getRoles(),

                'status' => $user->getStatus(),

                'photo' => $user->getPhoto()

                            ];

        }

        

        return $this->render('dashboard/user_add.html.twig', [

            'users' => $usersArray

        ]);

    }



    #[Route('/dashboard/users/create', name: 'dashboard_users_create', methods: ['POST'])]

    #[IsGranted('ROLE_ADMIN')]

    public function createUser(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response

    {

        $data = json_decode($request->getContent(), true);

        

        $user = new User();

        $user->setFirstName($data['firstName'] ?? '');

        $user->setLastName($data['lastName'] ?? '');

        $user->setEmail($data['email']);

        $user->setStatus($data['status'] ?? 'active');

        // Gestion de la photo
        if (isset($data['photoFile']) && $data['photoFile']) {
            $photoData = $data['photoFile'];
            $originalFilename = pathinfo($photoData['name'], PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photoData['extension'];
            
            try {
                // Décoder les données base64 et sauvegarder
                $photoData_decoded = base64_decode($photoData['data']);
                file_put_contents($this->getParameter('profiles_directory').'/'.$newFilename, $photoData_decoded);
                $user->setPhoto($newFilename);
            } catch (FileException $e) {
                error_log('Erreur lors de l\'upload de la photo: ' . $e->getMessage());
            }
        }

        $user->setAvatar($data['avatar'] ?? '01.png');

        $roleValue = $data['role'] === 'admin' ? 'ADMIN' : ($data['role'] === 'teacher' ? 'ENSEIGNANT' : 'USER');
        $user->setRole($roleValue);

        $user->setPassword($data['password']);

        

        $entityManager->persist($user);

        $entityManager->flush();

        

        // Get updated users list and serialize properly

        $users = $entityManager->getRepository(User::class)->findAll();

        $usersArray = [];

        foreach ($users as $user) {

            $usersArray[] = [

                'id' => $user->getId(),

                'name' => $user->getFirstName() . ' ' . $user->getLastName(),

                'email' => $user->getEmail(),


                'roles' => $user->getRoles(),

                'status' => $user->getStatus(),
                'photo' => $user->getPhoto()

            ];

        }

        return $this->json([

            'success' => true,

            'user' => [

                'id' => $user->getId(),
                'name' => $user->getFirstName() . ' ' . $user->getLastName(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
                'lastActive' => 'Just now',
                'photo' => $user->getPhoto()

            ],
            'users' => $usersArray // Return properly serialized users list

        ]);

    }



    #[Route('/dashboard/users/update/{id}', name: 'dashboard_users_update', methods: ['POST'])]

    #[IsGranted('ROLE_ADMIN')]

    public function updateUser(User $user, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response

    {

        $data = json_decode($request->getContent(), true);

        

        // Debug: Log incoming data

        error_log('Update user data: ' . print_r($data, true));

        error_log('User ID: ' . $user->getId());

        error_log('Original user name: ' . $user->getFirstName() . ' ' . $user->getLastName());

        

        $user->setFirstName($data['firstName'] ?? '');

        $user->setLastName($data['lastName'] ?? '');

        $user->setEmail($data['email']);

        

        // Gestion de la photo
        if (isset($data['photoFile']) && $data['photoFile']) {
            $photoData = $data['photoFile'];
            $originalFilename = pathinfo($photoData['name'], PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photoData['extension'];
            
            // Supprimer l'ancienne photo si elle existe
            if ($user->getPhoto()) {
                $oldFile = $this->getParameter('profiles_directory').'/'.$user->getPhoto();
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
            
            try {
                // Décoder les données base64 et sauvegarder
                $photoData_decoded = base64_decode($photoData['data']);
                file_put_contents($this->getParameter('profiles_directory').'/'.$newFilename, $photoData_decoded);
                $user->setPhoto($newFilename);
                error_log('Photo uploaded: ' . $newFilename);
            } catch (FileException $e) {
                error_log('Erreur lors de l\'upload de la photo: ' . $e->getMessage());
            }
        }

        // Set status

        $user->setStatus($data['status'] ?? 'active');

        error_log('Setting status to: ' . ($data['status'] ?? 'active'));

        

        // Set avatar

        $user->setAvatar($data['avatar'] ?? '01.png');

        error_log('Setting avatar to: ' . ($data['avatar'] ?? '01.png'));

        

        // Set roles based on selection

        $roleValue = $data['role'] === 'admin' ? 'ADMIN' : ($data['role'] === 'teacher' ? 'ENSEIGNANT' : 'USER');

        $user->setRole($roleValue);

        

        error_log('Setting role to: ' . $roleValue);

        

        if (!empty($data['password'])) {

            $user->setPassword($data['password']);

        }

        

        error_log('Updated user name: ' . $user->getFirstName() . ' ' . $user->getLastName());

        error_log('Updated user email: ' . $user->getEmail());

        error_log('Updated user roles: ' . print_r($user->getRoles(), true));

        

        try {

            $entityManager->flush();

            error_log('User flushed to database');

        } catch (\Exception $e) {

            error_log('Database flush error: ' . $e->getMessage());

            return $this->json(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);

        }

        

        // Get updated users list and serialize properly

        $users = $entityManager->getRepository(User::class)->findAll();

        $usersArray = [];

        foreach ($users as $user) {

            $usersArray[] = [

                'id' => $user->getId(),

                'name' => $user->getFirstName() . ' ' . $user->getLastName(),

                'email' => $user->getEmail(),


                'roles' => $user->getRoles(),

                'status' => $user->getStatus(),
                'photo' => $user->getPhoto()

            ];

        }

        return $this->json([

            'success' => true,

            'message' => 'User updated successfully',
            'user' => [
                'id' => $user->getId(),
                'name' => $user->getFirstName() . ' ' . $user->getLastName(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
                'photo' => $user->getPhoto()
            ],
            'users' => $usersArray // Return properly serialized users list

        ]);

    }



    #[Route('/dashboard/users/delete/{id}', name: 'dashboard_users_delete', methods: ['POST'])]

    #[IsGranted('ROLE_ADMIN')]

    public function deleteUser(User $user, EntityManagerInterface $entityManager): Response

    {

        $entityManager->remove($user);

        $entityManager->flush();

        

        // Get updated users list and serialize properly

        $users = $entityManager->getRepository(User::class)->findAll();

        $usersArray = [];

        foreach ($users as $user) {

            $usersArray[] = [

                'id' => $user->getId(),

                'name' => $user->getFirstName() . ' ' . $user->getLastName(),

                'email' => $user->getEmail(),


                'roles' => $user->getRoles(),

                'status' => $user->getStatus(),
                'photo' => $user->getPhoto()

            ];

        }


        return $this->json([

            'success' => true,

            'users' => $usersArray // Return properly serialized users list

        ]);

    }



    #[Route('/dashboard/widgets/data', name: 'dashboard_widgets_data')]

    #[IsGranted('ROLE_ADMIN')]

    public function widgetsData(): Response

    {

        return $this->render('dashboard/widgets_data.html.twig');

    }



    #[Route('/dashboard/widgets/static', name: 'dashboard_widgets_static')]

    #[IsGranted('ROLE_ADMIN')]

    public function widgetsStatic(): Response

    {

        return $this->render('dashboard/widgets_static.html.twig');

    }



    #[Route('/dashboard/add/quizz', name: 'add_quizz')]

    #[IsGranted('ROLE_ADMIN')]

    public function addQuizz(): Response

    {

        return $this->render('dashboard/add_quizz.html.twig');

    }



    #[Route('/dashboard/add/course', name: 'add_course')]

    #[IsGranted('ROLE_ADMIN')]

    public function addCourse(): Response

    {

        return $this->render('dashboard/add_course.html.twig');

    }



    #[Route('/dashboard/add/event', name: 'add_event')]

    #[IsGranted('ROLE_ADMIN')]

    public function addEvent(): Response

    {

        return $this->render('dashboard/add_event.html.twig');

    }



    #[Route('/dashboard/add/post', name: 'add_post')]

    #[IsGranted('ROLE_ADMIN')]

    public function addPost(): Response

    {

        return $this->render('dashboard/add_post.html.twig');

    }



    #[Route('/dashboard/orders', name: 'ecommerce_orders')]

    #[IsGranted('ROLE_ADMIN')]

    public function orders(): Response

    {

        return $this->render('dashboard/orders.html.twig');

    }



    #[Route('/dashboard/users/datatable', name: 'user_datatable')]

    #[IsGranted('ROLE_ADMIN')]

    public function userDatatable(): Response

    {

        return $this->render('dashboard/user_datatable.html.twig');

    }



    #[Route('/dashboard/events/datatable', name: 'event_datatable')]

    #[IsGranted('ROLE_ADMIN')]

    public function eventDatatable(): Response

    {

        return $this->render('dashboard/event_datatable.html.twig');

    }



    #[Route('/dashboard/feeds/datatable', name: 'feed_datatable')]

    #[IsGranted('ROLE_ADMIN')]

    public function feedDatatable(): Response

    {

        return $this->render('dashboard/feed_datatable.html.twig');

    }



    #[Route('/dashboard/courses/datatable', name: 'course_datatable')]

    #[IsGranted('ROLE_ADMIN')]

    public function courseDatatable(): Response

    {

        return $this->render('dashboard/course_datatable.html.twig');

    }



    #[Route('/dashboard/quizzes/datatable', name: 'quizz_datatable')]

    #[IsGranted('ROLE_ADMIN')]

    public function quizzDatatable(): Response

    {

        return $this->render('dashboard/quizz_datatable.html.twig');

    }



    #[Route('/dashboard/reclamations/datatable', name: 'reclamation_datatable')]

    #[IsGranted('ROLE_ADMIN')]

    public function reclamationDatatable(): Response

    {

        return $this->render('dashboard/reclamation_datatable.html.twig');

    }



    #[Route('/dashboard/charts/apex', name: 'charts_apex_chart')]

    #[IsGranted('ROLE_ADMIN')]

    public function chartsApex(): Response

    {

        return $this->render('dashboard/charts_apex.html.twig');

    }



    #[Route('/dashboard/charts/chartjs', name: 'charts_chartjs')]

    #[IsGranted('ROLE_ADMIN')]

    public function chartsChartjs(): Response

    {

        return $this->render('dashboard/charts_chartjs.html.twig');

    }



    #[Route('/dashboard/maps/google', name: 'map_google_maps')]

    #[IsGranted('ROLE_ADMIN')]

    public function mapGoogle(): Response

    {

        return $this->render('dashboard/map_google.html.twig');

    }



    #[Route('/dashboard/maps/vector', name: 'map_vector_maps')]

    #[IsGranted('ROLE_ADMIN')]

    public function mapVector(): Response

    {

        return $this->render('dashboard/map_vector.html.twig');

    }



    #[Route('/admin/dashboard', name: 'admin_dashboard')]

    #[IsGranted('ROLE_ADMIN')]

    public function adminDashboard(UserRepository $userRepository): Response

    {

        $stats = [

            'total_users' => $userRepository->count([]),

            'students' => count($userRepository->findByRole('ROLE_STUDENT')),

            'enseignants' => count($userRepository->findByRole('ROLE_ENSEIGNANT')),

            'admins' => count($userRepository->findByRole('ROLE_ADMIN')),

        ];

        

        return $this->render('dashboard/admin.html.twig', [

            'stats' => $stats,

            'user' => $this->getUser(),

        ]);

    }



    #[Route('/admin/users', name: 'admin_users')]

    #[IsGranted('ROLE_ADMIN')]

    public function adminUsers(UserRepository $userRepository): Response

    {

        $users = $userRepository->findAll();

        

        return $this->render('dashboard/users.html.twig', [

            'users' => $users,

        ]);

    }



    #[Route('/admin/users/add', name: 'admin_users_add', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function addUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            // Store password as plaintext for Java compatibility
            $plainPassword = $form->get('plainPassword')->getData();
            if ($plainPassword) {
                $user->setPassword($plainPassword);
            }
            
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash('success', 'Utilisateur créé avec succès !');
            
            return $this->redirectToRoute('admin_users');
        }
        
        return $this->render('dashboard/users/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/users/edit/{id}', name: 'admin_users_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function editUser(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user, ['edit_mode' => true]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $plainPassword = $form->get('plainPassword')->getData();
            if ($plainPassword) {
                $user->setPassword($plainPassword);
            }
            
            $entityManager->flush();
            
            $this->addFlash('success', 'Utilisateur mis à jour avec succès !');
            
            return $this->redirectToRoute('admin_users');
        }
        
        return $this->render('dashboard/users/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/debug/roles', name: 'debug_roles')]
    public function debugRoles(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return new Response('Not logged in');
        }
        
        return new Response('User: ' . ($user instanceof User ? $user->getEmail() : 'N/A') . 
                          '<br>Role property: ' . ($user instanceof User ? $user->getRoles()[0] ?? 'N/A' : 'N/A') . 
                          '<br>Roles array: ' . json_encode($user->getRoles()) .
                          '<br>Is admin: ' . (in_array('ROLE_ADMIN', $user->getRoles()) ? 'YES' : 'NO'));
    }

    // Missing User Management Routes

    #[Route('/dashboard/users/add', name: 'user_add')]

    #[IsGranted('ROLE_ADMIN')]

    public function userAdd(): Response

    {

        return $this->render('dashboard/user_add.html.twig');

    }



    #[Route('/dashboard/users/roles', name: 'user_roles')]

    #[IsGranted('ROLE_ADMIN')]

    public function userRoles(): Response

    {

        return $this->render('dashboard/user_roles.html.twig');

    }



    // Missing Course Management Routes

    #[Route('/dashboard/courses/categories', name: 'course_categories')]

    #[IsGranted('ROLE_ADMIN')]

    public function courseCategories(): Response

    {

        return $this->render('dashboard/course_categories.html.twig');

    }



    // Missing Quiz Management Routes

    #[Route('/dashboard/quizzes/results', name: 'quizz_results')]

    #[IsGranted('ROLE_ADMIN')]

    public function quizzResults(): Response

    {

        return $this->render('dashboard/quizz_results.html.twig');

    }



    // Missing Support Routes

    #[Route('/dashboard/support/tickets', name: 'support_tickets')]

    #[IsGranted('ROLE_ADMIN')]

    public function supportTickets(): Response

    {

        return $this->render('dashboard/support_tickets.html.twig');

    }



    #[Route('/dashboard/support/faq', name: 'faq_management')]

    #[IsGranted('ROLE_ADMIN')]

    public function faqManagement(): Response

    {

        return $this->render('dashboard/faq_management.html.twig');

    }



    // Missing Reports Routes

    #[Route('/dashboard/reports/sales', name: 'reports_sales')]

    #[IsGranted('ROLE_ADMIN')]

    public function reportsSales(): Response

    {

        return $this->render('dashboard/reports_sales.html.twig');

    }



    #[Route('/dashboard/reports/users', name: 'reports_users')]

    #[IsGranted('ROLE_ADMIN')]

    public function reportsUsers(): Response

    {

        return $this->render('dashboard/reports_users.html.twig');

    }



    #[Route('/dashboard/reports/courses', name: 'reports_courses')]

    #[IsGranted('ROLE_ADMIN')]

    public function reportsCourses(): Response

    {

        return $this->render('dashboard/reports_courses.html.twig');

    }



    // Missing Settings Routes

    #[Route('/dashboard/settings/general', name: 'settings_general')]

    #[IsGranted('ROLE_ADMIN')]

    public function settingsGeneral(): Response

    {

        return $this->render('dashboard/settings_general.html.twig');

    }



    #[Route('/dashboard/settings/security', name: 'settings_security')]

    #[IsGranted('ROLE_ADMIN')]

    public function settingsSecurity(): Response

    {

        return $this->render('dashboard/settings_security.html.twig');

    }



    #[Route('/dashboard/settings/notifications', name: 'settings_notifications')]

    #[IsGranted('ROLE_ADMIN')]

    public function settingsNotifications(): Response

    {

        return $this->render('dashboard/settings_notifications.html.twig');

    }



    #[Route('/dashboard/settings/theme', name: 'settings_theme')]

    #[IsGranted('ROLE_ADMIN')]

    public function settingsTheme(): Response

    {

        return $this->render('dashboard/settings_theme.html.twig');

    }



    // Missing E-commerce Routes

    #[Route('/dashboard/products', name: 'ecommerce_products')]

    #[IsGranted('ROLE_ADMIN')]

    public function ecommerceProducts(): Response

    {

        return $this->render('dashboard/ecommerce_products.html.twig');

    }



    #[Route('/dashboard/customers', name: 'dashboard_customers')]

    #[IsGranted('ROLE_ADMIN')]

    public function ecommerceCustomers(): Response

    {

        return $this->render('dashboard/ecommerce_customers.html.twig');

    }



    }

