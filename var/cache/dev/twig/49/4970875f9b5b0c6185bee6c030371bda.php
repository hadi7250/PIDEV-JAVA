<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* dashboard/index.html.twig */
class __TwigTemplate_56e2e409930d60464d2cec76ad9830b5 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'page_content' => [$this, 'block_page_content'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/index.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Maxton | Bootstrap 5 Admin Dashboard Template</title>
    
    <!-- Load ALL CSS files from public/Back_Office/assets/ -->
    <link rel=\"icon\" href=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/favicon-32x32.png"), "html", null, true);
        yield "\" type=\"image/png\">
    <link href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/pace.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/metismenu/metisMenu.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/metismenu/mm-vertical.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/simplebar/css/simplebar.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/bootstrap.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">
    <link href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/bootstrap-extended.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/main.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/dark-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/blue-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/semi-dark.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/bordered-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/responsive.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    
    <!-- Custom CSS Fixes -->
    <style>
        /* 1. Fix Search Bar */
        .header-search .search-input input {
            padding: 0.5rem 1rem 0.5rem 3rem !important;
            background-position: 1rem center !important;
            background-size: 20px 20px !important;
            height: 40px !important;
            font-size: 0.875rem !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 6px !important;
            width: 250px !important;
        }
        
        .header-search .search-input {
            position: relative;
        }
        
        .header-search .search-input .material-icons-outlined {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px !important;
            color: #6c757d;
        }
        
        /* 2. Fix Language Selector */
        .language-dropdown .btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            background: white;
            font-size: 0.875rem;
        }
        
        .language-dropdown .btn img {
            width: 20px;
            height: 20px;
            border-radius: 3px;
        }
        
        /* 3. Fix User Profile */
        .user-dropdown .btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            background: white;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .user-name {
            font-size: 0.875rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        /* 4. Fix Customize Button */
        .btn-customize {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background: #0d6efd;
            color: white;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .btn-customize:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        
        /* 5. Fix Performance Metrics Bar */
        .performance-metrics {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #212529;
            color: #adb5bd;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            z-index: 1030;
            border-top: 1px solid #495057;
        }
        
        .performance-metrics .d-flex {
            justify-content: space-between;
            align-items: center;
        }
        
        /* Cart Order Images with Fallback */
        .order-img {
            width: 75px;
            height: 75px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            overflow: hidden;
            position: relative;
        }
        
        .order-img img {
            object-fit: cover;
            border-radius: 12px;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .order-img img[src=\"\"], .order-img img:not([src]) {
            display: none;
        }
        
        .order-item {
            transition: all 0.2s ease;
        }
        
        .order-item:hover {
            background-color: #f8f9fa;
            transform: translateX(2px);
        }
        
        .order-delete {
            color: #6c757d;
            transition: color 0.2s ease;
        }
        
        .order-delete:hover {
            color: #dc3545;
        }
        
        /* 6. Fix Header Alignment */
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        /* 7. Ensure proper icon sizing */
        .material-icons-outlined {
            font-size: 20px !important;
            vertical-align: middle;
        }
        
        /* 8. Fix dropdown menus */
        .dropdown-menu {
        }
        
        .page-content {
            flex: 1;
            padding: 1rem;
            margin-top: 0;
        }
        
        /* 9. Dashboard welcome section height */
        .card.w-100.overflow-hidden.rounded-4 {
            min-height: 200px;
        }
        
        .welcome-back-img {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            height: 100%;
        }
        
        /* 10. Responsive fixes */
        @media (max-width: 768px) {
            .header-search .search-input input {
                width: 200px !important;
            }
            
            .language-dropdown .btn span,
            .user-dropdown .btn .user-name {
                display: none !important;
            }
            
            .header-right {
                gap: 0.5rem !important;
            }
        }
        
        @media (max-width: 1400px) {
            .col-xxl-4, .col-xxl-8, .col-xxl-2 {
                flex: 0 0 auto;
                width: 100%;
            }
        }
        
        /* 10. Fix header search icon positioning */
        .header-search .search-input {
            position: relative;
        }
        
        .header-search .search-input .material-icons-outlined {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 18px !important;
            color: #6c757d;
        }
        
        /* 11. Fix header overall styling */
        .header {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        /* 12. Fix dropdown arrows */
        .dropdown-toggle::after {
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            margin-left: 0.5rem;
        }
        
        /* 13. Fix notification badge */
        .badge-notify {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        /* 14. Fix apps dropdown grid */
        .apps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.5rem;
            padding: 0.5rem;
            min-width: 300px;
        }
        
        .app-item {
            text-align: center;
            padding: 0.5rem;
            border-radius: 6px;
            transition: background-color 0.2s;
        }
        
        .app-item:hover {
            background-color: #f8f9fa;
        }
        
        .app-item a {
            text-decoration: none;
            color: inherit;
            font-size: 0.75rem;
        }
        
        .app-item img {
            width: 32px;
            height: 32px;
            margin-bottom: 0.25rem;
        }
        
        /* 15. Fix notification items */
        .notify-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f3f5;
            transition: background-color 0.2s;
        }
        
        .notify-item:hover {
            background-color: #f8f9fa;
        }
        
        .notify-item:last-child {
            border-bottom: none;
        }
        
        /* 16. Fix metrics bar spacing */
        .metrics-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .metrics-right {
            font-weight: 500;
        }
        
        /* 17. Fix button hover states */
        .btn:hover {
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
        
        /* 18. Fix card shadows */
        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.2s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* 12. Simple background fix */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        .page-wrapper {
            background: transparent;
            min-height: 100vh;
        }
        
        .page-content {
            background: rgba(255, 255, 255, 0.95);
            margin: 0 1rem 1rem 1rem;
            border-radius: 1rem;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }
        
        /* Remove top spacing to reach navbar */
        .page-wrapper {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        
        /* Adjust breadcrumb area */
        .breadcrumb-area {
            padding-top: 1rem;
        }
    </style>
</head>
<body>

<!-- Start adding HTML chunks here -->

<!-- CHUNK A: HEADER WITH MEGA MENU, LANGUAGE, NOTIFICATIONS -->
<div class=\"header\">
    <div class=\"header-left\">
        <div class=\"menu-toggle\">
            <span class=\"material-icons-outlined\">menu</span>
        </div>
            </div>
    <div class=\"header-right\">
        <div class=\"header-search\">
            <div class=\"search-input\">
                <span class=\"material-icons-outlined\">search</span>
                <input type=\"text\" placeholder=\"Search...\">
            </div>
        </div>
        
        <!-- LANGUAGE DROPDOWN -->
        <div class=\"dropdown language-dropdown\">
            <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                <img src=\"";
        // line 424
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/county/01.png"), "html", null, true);
        yield "\" alt=\"Language\">
                <span>English</span>
            </button>
            <ul class=\"dropdown-menu\">
                ";
        // line 428
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 429
            yield "                <li>
                    <a class=\"dropdown-item\" href=\"#\">
                        <img src=\"";
            // line 431
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("Back_Office/assets/images/county/0" . $context["i"]) . ".png")), "html", null, true);
            yield "\" alt=\"Language ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "\">
                        ";
            // line 432
            if (($context["i"] == 1)) {
                yield "English";
            } elseif (($context["i"] == 2)) {
                yield "Spanish";
            } elseif (($context["i"] == 3)) {
                yield "French";
            } elseif (($context["i"] == 4)) {
                yield "German";
            } elseif (($context["i"] == 5)) {
                yield "Italian";
            } elseif (($context["i"] == 6)) {
                yield "Chinese";
            } elseif (($context["i"] == 7)) {
                yield "Japanese";
            } elseif (($context["i"] == 8)) {
                yield "Arabic";
            }
            // line 433
            yield "                    </a>
                </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 436
        yield "            </ul>
        </div>
        
        <!-- APPS DROPDOWN -->
        <div class=\"dropdown apps-dropdown\">
            <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                <span class=\"material-icons-outlined\">apps</span>
            </button>
            <div class=\"dropdown-menu dropdown-menu-end\">
                <div class=\"apps-grid\">
                    ";
        // line 446
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 12));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 447
            yield "                    <div class=\"app-item\">
                        <a href=\"#\">
                            <img src=\"";
            // line 449
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl((("Back_Office/assets/images/apps/" . ((($context["i"] < 10)) ? (("0" . $context["i"])) : ($context["i"]))) . ".png")), "html", null, true);
            yield "\" alt=\"App ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "\">
                            <span>App ";
            // line 450
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "</span>
                        </a>
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 454
        yield "                </div>
            </div>
        </div>
        
        <!-- NOTIFICATIONS DROPDOWN -->
        <div class=\"dropdown notifications-dropdown\">
            <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                <span class=\"material-icons-outlined\">notifications</span>
                <span class=\"badge\">7</span>
            </button>
            <ul class=\"dropdown-menu dropdown-menu-end\">
                ";
        // line 465
        $context["notifications"] = [["icon" => "mail", "text" => "New email received", "time" => "5 min ago"], ["icon" => "person", "text" => "New user registered", "time" => "10 min ago"], ["icon" => "shopping_cart", "text" => "New order placed", "time" => "15 min ago"], ["icon" => "message", "text" => "New message received", "time" => "20 min ago"], ["icon" => "star", "text" => "New review posted", "time" => "25 min ago"], ["icon" => "warning", "text" => "System warning", "time" => "30 min ago"], ["icon" => "info", "text" => "System update available", "time" => "1 hour ago"]];
        // line 474
        yield "                ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["notifications"]) || array_key_exists("notifications", $context) ? $context["notifications"] : (function () { throw new RuntimeError('Variable "notifications" does not exist.', 474, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["notification"]) {
            // line 475
            yield "                <li>
                    <a class=\"dropdown-item\" href=\"#\">
                        <span class=\"material-icons-outlined\">";
            // line 477
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "icon", [], "any", false, false, false, 477), "html", null, true);
            yield "</span>
                        <div class=\"notification-content\">
                            <p>";
            // line 479
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "text", [], "any", false, false, false, 479), "html", null, true);
            yield "</p>
                            <span class=\"time\">";
            // line 480
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "time", [], "any", false, false, false, 480), "html", null, true);
            yield "</span>
                        </div>
                    </a>
                </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['notification'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 485
        yield "                <li><hr class=\"dropdown-divider\"></li>
                <li><a class=\"dropdown-item\" href=\"#\">View all notifications</a></li>
            </ul>
        </div>
        
        <!-- GO TO FRONT BUTTON -->
        <a href=\"";
        // line 491
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\" class=\"btn btn-primary btn-sm\">
            <span class=\"material-icons-outlined\">home</span>
            Go to Front
        </a>
        
        <!-- USER PROFILE -->
        <div class=\"dropdown user-dropdown\">
            <button class=\"btn dropdown-toggle d-flex align-items-center\" type=\"button\" data-bs-toggle=\"dropdown\">
                <img src=\"";
        // line 499
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/avatars/01.png"), "html", null, true);
        yield "\" alt=\"User\" class=\"user-avatar\">
                <span class=\"user-name\">";
        // line 500
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 500, $this->source); })()), "user", [], "any", false, false, false, 500)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 500, $this->source); })()), "user", [], "any", false, false, false, 500), "email", [], "any", false, false, false, 500), "html", null, true)) : ("Admin User"));
        yield "</span>
            </button>
            <ul class=\"dropdown-menu dropdown-menu-end\">
                <li><a class=\"dropdown-item\" href=\"";
        // line 503
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
        yield "\"><span class=\"material-icons-outlined\">person</span> Profile</a></li>
                <li><a class=\"dropdown-item\" href=\"#\"><span class=\"material-icons-outlined\">settings</span> Settings</a></li>
                <li><hr class=\"dropdown-divider\"></li>
                <li><a class=\"dropdown-item\" href=\"";
        // line 506
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\"><span class=\"material-icons-outlined\">logout</span> Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- CHUNK B: COMPLETE SIDEBAR -->
<!--start sidebar-->
<aside class=\"sidebar-wrapper\" data-simplebar=\"true\">
    <div class=\"sidebar-header\">
        <div class=\"logo-icon\">
            <img src=\"";
        // line 517
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/logo-icon.png"), "html", null, true);
        yield "\" class=\"logo-img\" alt=\"\">
        </div>
        <div class=\"logo-name flex-grow-1\">
            <h5 class=\"mb-0\">Maxton</h5>
        </div>
        <div class=\"sidebar-close\">
            <span class=\"material-icons-outlined\">close</span>
        </div>
    </div>
    <div class=\"sidebar-nav\">
        <!--navigation-->
        <ul class=\"metismenu\" id=\"sidenav\">
            <li>
                <a href=\"";
        // line 530
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_index");
        yield "\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">home</i></div>
                    <div class=\"menu-title\">Dashboard</div>
                </a>
            </li>
            
            <li class=\"menu-label\">Users Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">people</i></div>
                    <div class=\"menu-title\">Users</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 543
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_datatable");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>All Users</a></li>
                    <li><a href=\"";
        // line 544
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_add");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Add New User</a></li>
                    <li><a href=\"";
        // line 545
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_roles");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Roles & Permissions</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Courses Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">school</i></div>
                    <div class=\"menu-title\">Courses</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 556
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("course_datatable");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>All Courses</a></li>
                    <li><a href=\"";
        // line 557
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("add_course");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Add Course</a></li>
                    <li><a href=\"";
        // line 558
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("course_categories");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Categories</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Quizzes Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">quiz</i></div>
                    <div class=\"menu-title\">Quizzes</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 569
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("quizz_datatable");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>All Quizzes</a></li>
                    <li><a href=\"";
        // line 570
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("add_quizz");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Add Quiz</a></li>
                    <li><a href=\"";
        // line 571
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("quizz_results");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Results</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Content Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">article</i></div>
                    <div class=\"menu-title\">Posts & Events</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 582
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("add_post");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Add Post</a></li>
                    <li><a href=\"";
        // line 583
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("add_event");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Add Event</a></li>
                    <li><a href=\"";
        // line 584
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("feed_datatable");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>All Feeds</a></li>
                    <li><a href=\"";
        // line 585
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_datatable");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>All Events</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">User Management</li>
            <li>
                <a href=\"";
        // line 591
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_users_add");
        yield "\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">people</i></div>
                    <div class=\"menu-title\">User Management</div>
                </a>
            </li>
            
            <li class=\"menu-label\">Orders & E-commerce</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">shopping_cart</i></div>
                    <div class=\"menu-title\">Orders</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 604
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ecommerce_orders");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>All Orders</a></li>
                    <li><a href=\"";
        // line 605
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ecommerce_products");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Products</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Support</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">support_agent</i></div>
                    <div class=\"menu-title\">Support</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 616
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("reclamation_datatable");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Reclamations</a></li>
                    <li><a href=\"";
        // line 617
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("support_tickets");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Tickets</a></li>
                    <li><a href=\"";
        // line 618
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("faq_management");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>FAQ</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Reports & Analytics</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">analytics</i></div>
                    <div class=\"menu-title\">Reports</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 629
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("reports_sales");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Sales Reports</a></li>
                    <li><a href=\"";
        // line 630
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("reports_users");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>User Reports</a></li>
                    <li><a href=\"";
        // line 631
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("reports_courses");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Course Reports</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Settings</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">settings</i></div>
                    <div class=\"menu-title\">Settings</div>
                </a>
                <ul>
                    <li><a href=\"";
        // line 642
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("settings_general");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>General Settings</a></li>
                    <li><a href=\"";
        // line 643
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("settings_security");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Security</a></li>
                    <li><a href=\"";
        // line 644
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("settings_notifications");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Notifications</a></li>
                    <li><a href=\"";
        // line 645
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("settings_theme");
        yield "\"><i class=\"material-icons-outlined\">arrow_right</i>Theme Settings</a></li>
                </ul>
            </li>
            
            <li>
                <a href=\"";
        // line 650
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">logout</i></div>
                    <div class=\"menu-title\">Logout</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->

<!-- CHUNK C PART 1: MAIN CONTENT -->
<!--start main wrapper-->
<main class=\"main-wrapper\">
    <div class=\"main-content\">
        ";
        // line 665
        yield from $this->unwrap()->yieldBlock('page_content', $context, $blocks);
        // line 1165
        yield "    </div>
    <!-- Close main-content div -->
</main>
<!--end main wrapper-->

<!--start overlay-->
<div class=\"overlay btn-toggle\"></div>
<!--end overlay-->

<!--start footer-->
<footer class=\"page-footer\">
    <p class=\"mb-0\">Copyright  2023. All right reserved.</p>
</footer>
<!--end footer-->

<!--start cart-->
<div class=\"offcanvas offcanvas-end\" tabindex=\"-1\" id=\"offcanvasCart\">
    <div class=\"offcanvas-header border-bottom h-70\">
        <h5 class=\"mb-0\" id=\"offcanvasRightLabel\">8 New Orders</h5>
        <a href=\"javascript:;\" class=\"primaery-menu-close\" data-bs-dismiss=\"offcanvas\">
            <i class=\"material-icons-outlined\">close</i>
        </a>
    </div>
    <div class=\"offcanvas-body p-0\">
        <div class=\"order-list\">
            ";
        // line 1190
        $context["cartOrders"] = [["img" => "01.png", "title" => "White Men Shoes", "price" => "\$289"], ["img" => "02.png", "title" => "Red Airpods", "price" => "\$149"], ["img" => "03.png", "title" => "Men Polo Tshirt", "price" => "\$139"], ["img" => "04.png", "title" => "Blue Jeans Casual", "price" => "\$485"], ["img" => "05.png", "title" => "Fancy Shirts", "price" => "\$758"], ["img" => "06.png", "title" => "Home Sofa Set", "price" => "\$546"], ["img" => "07.png", "title" => "Black iPhone", "price" => "\$1049"], ["img" => "08.png", "title" => "Goldan Watch", "price" => "\$689"]];
        // line 1200
        yield "            
            ";
        // line 1201
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["cartOrders"]) || array_key_exists("cartOrders", $context) ? $context["cartOrders"] : (function () { throw new RuntimeError('Variable "cartOrders" does not exist.', 1201, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 1202
            yield "            <div class=\"order-item d-flex align-items-center gap-3 p-3 border-bottom\">
                <div class=\"order-img\">
                    <img src=\"";
            // line 1204
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("Back_Office/assets/images/orders/" . CoreExtension::getAttribute($this->env, $this->source, $context["order"], "img", [], "any", false, false, false, 1204))), "html", null, true);
            yield "\" class=\"img-fluid rounded-3\" width=\"75\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "title", [], "any", false, false, false, 1204), "html", null, true);
            yield "\" loading=\"lazy\">
                </div>
                <div class=\"order-info flex-grow-1\">
                    <h5 class=\"mb-1 order-title\">";
            // line 1207
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "title", [], "any", false, false, false, 1207), "html", null, true);
            yield "</h5>
                    <p class=\"mb-0 order-price\">";
            // line 1208
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "price", [], "any", false, false, false, 1208), "html", null, true);
            yield "</p>
                </div>
                <div class=\"d-flex\">
                    <a class=\"order-delete\" href=\"javascript:;\"><span class=\"material-icons-outlined\">delete</span></a>
                    <a class=\"order-delete\" href=\"javascript:;\"><span class=\"material-icons-outlined\">visibility</span></a>
                </div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['order'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1216
        yield "        </div>
    </div>
    <div class=\"offcanvas-footer h-70 p-3 border-top\">
        <div class=\"d-grid\">
            <a href=\"";
        // line 1220
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ecommerce_orders");
        yield "\" class=\"btn btn-grd btn-grd-primary\">View All Orders</a>
        </div>
    </div>
</div>
<!--end cart-->

<!--start switcher-->
<button class=\"btn btn-grd btn-grd-primary position-fixed bottom-0 end-0 m-3 d-flex align-items-center gap-2\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#staticBackdrop\">
    <i class=\"material-icons-outlined\">tune</i>Customize
</button>

<div class=\"offcanvas offcanvas-end\" data-bs-scroll=\"true\" tabindex=\"-1\" id=\"staticBackdrop\">
    <div class=\"offcanvas-header border-bottom h-70\">
        <div class=\"\">
            <h5 class=\"mb-0\">Theme Customizer</h5>
            <p class=\"mb-0\">Customize your theme</p>
        </div>
        <a href=\"javascript:;\" class=\"primaery-menu-close\" data-bs-dismiss=\"offcanvas\">
            <i class=\"material-icons-outlined\">close</i>
        </a>
    </div>
    <div class=\"offcanvas-body\">
        <div>
            <p>Theme variation</p>
            <div class=\"row g-3\">
                ";
        // line 1245
        $context["themes"] = [["id" => "BlueTheme", "icon" => "contactless", "label" => "Blue"], ["id" => "LightTheme", "icon" => "light_mode", "label" => "Light"], ["id" => "DarkTheme", "icon" => "dark_mode", "label" => "Dark"], ["id" => "SemiDarkTheme", "icon" => "contrast", "label" => "Semi Dark"], ["id" => "BoderedTheme", "icon" => "border_style", "label" => "Bordered"]];
        // line 1252
        yield "                
                ";
        // line 1253
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["themes"]) || array_key_exists("themes", $context) ? $context["themes"] : (function () { throw new RuntimeError('Variable "themes" does not exist.', 1253, $this->source); })()));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
            // line 1254
            yield "                <div class=\"col-12 col-xl-6\">
                    <input type=\"radio\" class=\"btn-check\" name=\"theme-options\" id=\"";
            // line 1255
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "id", [], "any", false, false, false, 1255), "html", null, true);
            yield "\" ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 1255)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "checked";
            }
            yield ">
                    <label class=\"btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4\" for=\"";
            // line 1256
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "id", [], "any", false, false, false, 1256), "html", null, true);
            yield "\">
                        <span class=\"material-icons-outlined\">";
            // line 1257
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "icon", [], "any", false, false, false, 1257), "html", null, true);
            yield "</span>
                        <span>";
            // line 1258
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["theme"], "label", [], "any", false, false, false, 1258), "html", null, true);
            yield "</span>
                    </label>
                </div>
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1262
        yield "            </div>
        </div>
    </div>
</div>
<!--end switcher-->

";
        // line 1268
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 1618
        yield "
<!-- Performance Metrics Bar -->
<div class=\"performance-metrics\">
    <div class=\"metrics-left\">
        <span>75 requêtes</span>
        <span>|</span>
        <span>180 ko</span>
        <span>|</span>
        <span>12 ms</span>
    </div>
    <div class=\"metrics-right\">
        <span>Symfony Debug Toolbar</span>
    </div>
</div>

<!-- Hide Symfony debug toolbar and fix missing images -->
<style>
    /* Hide Symfony debug toolbar */
    .sf-toolbar, .sf-minitoolbar {
        display: none !important;
    }
    
    /* Hide performance metrics bar if it's from Symfony */
    body > div:last-child {
        display: none !important;
    }
</style>

<script>
    // Fix missing 08.png image
    document.addEventListener('DOMContentLoaded', function() {
        const img08 = document.querySelector('img[src*=\"08.png\"]');
        if (img08) {
            img08.onerror = function() {
                this.src = '";
        // line 1652
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/orders/01.png"), "html", null, true);
        yield "'; // Fallback to existing image
                this.style.backgroundColor = '#f0f0f0'; // Add background color
            };
        }
        
        // Fix all missing images with assets_back paths
        const allImages = document.querySelectorAll('img[src*=\"assets_back\"]');
        allImages.forEach(function(img) {
            img.src = img.src.replace('assets_back', 'Back_Office/assets');
        });
    });
</script>

</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 665
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_content"));

        // line 666
        yield "        <!--breadcrumb-->
        <div class=\"page-breadcrumb d-none d-sm-flex align-items-center mb-3\">
            <div class=\"breadcrumb-title pe-3\">Dashboard</div>
            <div class=\"ps-3\">
                <nav aria-label=\"breadcrumb\">
                    <ol class=\"breadcrumb mb-0 p-0\">
                        <li class=\"breadcrumb-item\"><a href=\"javascript:;\"><i class=\"bx bx-home-alt\"></i></a></li>
                        <li class=\"breadcrumb-item active\" aria-current=\"page\">Analysis</li>
                    </ol>
                </nav>
            </div>
            <div class=\"ms-auto\">
                <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-outline-primary\">Settings</button>
                    <button type=\"button\" class=\"btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split\" data-bs-toggle=\"dropdown\">
                        <span class=\"visually-hidden\">Toggle Dropdown</span>
                    </button>
                    <div class=\"dropdown-menu dropdown-menu-right dropdown-menu-lg-end\">
                        <a class=\"dropdown-item\" href=\"javascript:;\">Action</a>
                        <a class=\"dropdown-item\" href=\"javascript:;\">Another action</a>
                        <a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a>
                        <div class=\"dropdown-divider\"></div>
                        <a class=\"dropdown-item\" href=\"javascript:;\">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
     
        <div class=\"row\">
            <!-- Welcome Card -->
            <div class=\"col-xxl-8 d-flex align-items-stretch\">
                <div class=\"card w-100 overflow-hidden rounded-4\">
                    <div class=\"card-body position-relative p-4\">
                        <div class=\"row\">
                            <div class=\"col-12 col-sm-7\">
                                <div class=\"d-flex align-items-center gap-3 mb-5\">
                                    <img src=\"";
        // line 703
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/avatars/01.png"), "html", null, true);
        yield "\" class=\"rounded-circle bg-grd-info p-1\" width=\"60\" height=\"60\" alt=\"user\">
                                    <div class=\"\">
                                        <p class=\"mb-0 fw-semibold\">Welcome back</p>
                                        <h4 class=\"fw-semibold mb-0 fs-4 mb-0\">";
        // line 706
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 706, $this->source); })()), "user", [], "any", false, false, false, 706)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 706, $this->source); })()), "user", [], "any", false, false, false, 706), "firstName", [], "any", false, false, false, 706) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 706, $this->source); })()), "user", [], "any", false, false, false, 706), "lastName", [], "any", false, false, false, 706))), "html", null, true)) : ("Admin"));
        yield "!</h4>
                                    </div>
                                </div>
                                <div class=\"d-flex align-items-center gap-5\">
                                    <div class=\"\">
                                        <h4 class=\"mb-1 fw-semibold d-flex align-content-center\">\$65.4K<i class=\"ti ti-arrow-up-right fs-5 lh-base text-success\"></i></h4>
                                        <p class=\"mb-3\">Today's Sales</p>
                                        <div class=\"progress mb-0\" style=\"height:5px;\">
                                            <div class=\"progress-bar bg-grd-success\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                        </div>
                                    </div>
                                    <div class=\"vr\"></div>
                                    <div class=\"\">
                                        <h4 class=\"mb-1 fw-semibold d-flex align-content-center\">78.4%<i class=\"ti ti-arrow-up-right fs-5 lh-base text-success\"></i></h4>
                                        <p class=\"mb-3\">Growth Rate</p>
                                        <div class=\"progress mb-0\" style=\"height:5px;\">
                                            <div class=\"progress-bar bg-grd-danger\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-12 col-sm-5\">
                                <div class=\"welcome-back-img pt-4\">
                                    <img src=\"";
        // line 729
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/gallery/welcome-back-3.png"), "html", null, true);
        yield "\" height=\"180\" alt=\"\">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Widgets -->
            <div class=\"col-xl-6 col-xxl-2 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-1\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">42.5K</h5>
                                <p class=\"mb-0\">Active Users</p>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"chart-container2\">
                            <div id=\"chart1\"></div>
                        </div>
                        <div class=\"text-center\">
                            <p class=\"mb-0 font-12\">24K users increased from last month</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"col-xl-6 col-xxl-2 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">97.4K</h5>
                                <p class=\"mb-0\">Total Users</p>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"chart-container2\">
                            <div id=\"chart2\"></div>
                        </div>
                        <div class=\"text-center\">
                            <p class=\"mb-0 font-12\"><span class=\"text-success me-1\">12.5%</span> from last month</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Chart -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"text-center\">
                            <h6 class=\"mb-0\">Monthly Revenue</h6>
                        </div>
                        <div class=\"mt-4\" id=\"chart5\"></div>
                        <p>Average monthly sale for every author</p>
                        <div class=\"d-flex align-items-center gap-3 mt-4\">
                            <div class=\"\">
                                <h1 class=\"mb-0 text-primary\">68.9%</h1>
                            </div>
                            <div class=\"d-flex align-items-center align-self-end\">
                                <p class=\"mb-0 text-success\">34.5%</p>
                                <span class=\"material-icons-outlined text-success\">expand_less</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Device Type Chart -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">Device Type</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"position-relative\">
                            <div class=\"piechart-legend\">
                                <h2 class=\"mb-1\">68%</h2>
                                <h6 class=\"mb-0\">Total Views</h6>
                            </div>
                            <div id=\"chart6\"></div>
                        </div>
                        <div class=\"d-flex flex-column gap-3\">
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <p class=\"mb-0 d-flex align-items-center gap-2 w-25\">
                                    <span class=\"material-icons-outlined fs-6 text-primary\">desktop_windows</span>Desktop
                                </p>
                                <div class=\"\">
                                    <p class=\"mb-0\">35%</p>
                                </div>
                            </div>
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <p class=\"mb-0 d-flex align-items-center gap-2 w-25\">
                                    <span class=\"material-icons-outlined fs-6 text-danger\">tablet_mac</span>Tablet
                                </p>
                                <div class=\"\">
                                    <p class=\"mb-0\">48%</p>
                                </div>
                            </div>
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <p class=\"mb-0 d-flex align-items-center gap-2 w-25\">
                                    <span class=\"material-icons-outlined fs-6 text-success\">phone_android</span>Mobile
                                </p>
                                <div class=\"\">
                                    <p class=\"mb-0\">27%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Campaign Stats -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h6 class=\"mb-0 fw-bold\">Campaign Stats</h6>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>

                        <ul class=\"list-group list-group-flush\">
                            ";
        // line 895
        $context["campaignStats"] = [["icon" => "calendar_today", "bg" => "grd-primary", "title" => "Campaigns", "value" => "54", "percent" => "28%", "color" => "success"], ["icon" => "email", "bg" => "grd-success", "title" => "Emailed", "value" => "245", "percent" => "15%", "color" => "danger"], ["icon" => "open_in_new", "bg" => "grd-branding", "title" => "Opened", "value" => "54", "percent" => "30.5%", "color" => "success"], ["icon" => "ads_click", "bg" => "grd-warning", "title" => "Clicked", "value" => "859", "percent" => "34.6%", "color" => "danger"], ["icon" => "subscriptions", "bg" => "grd-info", "title" => "Subscribed", "value" => "24,758", "percent" => "53%", "color" => "success"], ["icon" => "inbox", "bg" => "grd-danger", "title" => "Spam Message", "value" => "548", "percent" => "47%", "color" => "danger"], ["icon" => "visibility", "bg" => "grd-deep-blue", "title" => "Views Mails", "value" => "9845", "percent" => "68%", "color" => "success"]];
        // line 904
        yield "                            
                            ";
        // line 905
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["campaignStats"]) || array_key_exists("campaignStats", $context) ? $context["campaignStats"] : (function () { throw new RuntimeError('Variable "campaignStats" does not exist.', 905, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["stat"]) {
            // line 906
            yield "                            <li class=\"list-group-item px-0 bg-transparent\">
                                <div class=\"d-flex align-items-center gap-3\">
                                    <div class=\"wh-42 d-flex align-items-center justify-content-center rounded-3 bg-";
            // line 908
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "bg", [], "any", false, false, false, 908), "html", null, true);
            yield "\">
                                        <span class=\"material-icons-outlined text-white\">";
            // line 909
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "icon", [], "any", false, false, false, 909), "html", null, true);
            yield "</span>
                                    </div>
                                    <div class=\"flex-grow-1\">
                                        <h6 class=\"mb-0\">";
            // line 912
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "title", [], "any", false, false, false, 912), "html", null, true);
            yield "</h6>
                                    </div>
                                    <div class=\"d-flex align-items-center gap-3\">
                                        <p class=\"mb-0\">";
            // line 915
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "value", [], "any", false, false, false, 915), "html", null, true);
            yield "</p>
                                        <p class=\"mb-0 fw-bold text-";
            // line 916
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "color", [], "any", false, false, false, 916), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "percent", [], "any", false, false, false, 916), "html", null, true);
            yield "</p>
                                    </div>
                                </div>
                            </li>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['stat'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 921
        yield "                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Close the first row -->

        <div class=\"row mt-4\">
            <!-- Social Leads -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0 fw-bold\">Social Leads</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class=\"d-flex flex-column justify-content-between gap-4\">
                            ";
        // line 950
        $context["socialLeads"] = [["img" => "17.png", "name" => "Facebook", "percent" => "55%", "color" => "#0d6efd"], ["img" => "18.png", "name" => "LinkedIn", "percent" => "67%", "color" => "#fc185a"], ["img" => "19.png", "name" => "Instagram", "percent" => "78%", "color" => "#02c27a"], ["img" => "20.png", "name" => "Snapchat", "percent" => "46%", "color" => "#fd7e14"], ["img" => "05.png", "name" => "Google", "percent" => "38%", "color" => "#0dcaf0"], ["img" => "08.png", "name" => "Altaba", "percent" => "15%", "color" => "#6f42c1"], ["img" => "07.png", "name" => "Spotify", "percent" => "12%", "color" => "#ff00b3"]];
        // line 959
        yield "                            
                            ";
        // line 960
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["socialLeads"]) || array_key_exists("socialLeads", $context) ? $context["socialLeads"] : (function () { throw new RuntimeError('Variable "socialLeads" does not exist.', 960, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["social"]) {
            // line 961
            yield "                            <div class=\"d-flex align-items-center gap-4\">
                                <div class=\"d-flex align-items-center gap-3 flex-grow-1\">
                                    <img src=\"";
            // line 963
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("Back_Office/assets/images/apps/" . CoreExtension::getAttribute($this->env, $this->source, $context["social"], "img", [], "any", false, false, false, 963))), "html", null, true);
            yield "\" width=\"32\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["social"], "name", [], "any", false, false, false, 963), "html", null, true);
            yield "\">
                                    <p class=\"mb-0\">";
            // line 964
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["social"], "name", [], "any", false, false, false, 964), "html", null, true);
            yield "</p>
                                </div>
                                <div class=\"\">
                                    <p class=\"mb-0 fs-6\">";
            // line 967
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["social"], "percent", [], "any", false, false, false, 967), "html", null, true);
            yield "</p>
                                </div>
                                <div class=\"\">
                                    <p class=\"mb-0 data-attributes\">
                                        <span data-peity='{ \"fill\": [\"";
            // line 971
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["social"], "color", [], "any", false, false, false, 971), "html", null, true);
            yield "\", \"rgb(255 255 255 / 10%)\"], \"innerRadius\": 14, \"radius\": 18 }'>5/7</span>
                                    </p>
                                </div>
                            </div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['social'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 976
        yield "                        </div>
                    </div>
                </div>
            </div>

            <!-- New Users List -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-header border-0 p-3 border-bottom\">
                        <div class=\"d-flex align-items-start justify-content-between\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">New Users</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=\"card-body p-0\">
                        <div class=\"user-list p-3\">
                            <div class=\"d-flex flex-column gap-3\">
                                                            </div>
                        </div>
                    </div>
                    <div class=\"card-footer bg-transparent p-3\">
                        <div class=\"d-flex align-items-center justify-content-between gap-3\">
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">share</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">textsms</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">email</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">attach_file</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">event</i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class=\"col-lg-12 col-xxl-8 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">Recent Orders</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class=\"order-search position-relative my-3\">
                            <input class=\"form-control rounded-5 px-5\" type=\"text\" placeholder=\"Search\">
                            <span class=\"material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50\">search</span>
                        </div>
                        
                        <div class=\"table-responsive\">
                            <table class=\"table align-middle\">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Amount</th>
                                        <th>Vendor</th>
                                        <th>Status</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
        // line 1056
        $context["recentOrders"] = [["img" => "01.png", "name" => "Sports Shoes", "price" => "\$289", "vendor" => "Nike Store", "status" => "Completed", "rating" => "4.5"], ["img" => "02.png", "name" => "Red Airpods", "price" => "\$149", "vendor" => "Apple Store", "status" => "Pending", "rating" => "4.8"], ["img" => "03.png", "name" => "Men Polo Tshirt", "price" => "\$139", "vendor" => "Fashion Hub", "status" => "Completed", "rating" => "4.2"], ["img" => "04.png", "name" => "Blue Jeans Casual", "price" => "\$485", "vendor" => "Denim Co", "status" => "Pending", "rating" => "4.0"], ["img" => "05.png", "name" => "Fancy Shirts", "price" => "\$758", "vendor" => "Premium Wear", "status" => "Completed", "rating" => "4.7"], ["img" => "06.png", "name" => "Home Sofa Set", "price" => "\$546", "vendor" => "Furniture Plus", "status" => "Canceled", "rating" => "3.8"], ["img" => "07.png", "name" => "Black iPhone", "price" => "\$1049", "vendor" => "Tech World", "status" => "Completed", "rating" => "4.9"], ["img" => "08.png", "name" => "Goldan Watch", "price" => "\$689", "vendor" => "Watch Gallery", "status" => "Pending", "rating" => "4.3"]];
        // line 1066
        yield "                                    
                                    ";
        // line 1067
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recentOrders"]) || array_key_exists("recentOrders", $context) ? $context["recentOrders"] : (function () { throw new RuntimeError('Variable "recentOrders" does not exist.', 1067, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 1068
            yield "                                    <tr>
                                        <td>
                                            <div class=\"d-flex align-items-center gap-3\">
                                                <div class=\"\">
                                                    <img src=\"";
            // line 1072
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("Back_Office/assets/images/top-products/" . CoreExtension::getAttribute($this->env, $this->source, $context["order"], "img", [], "any", false, false, false, 1072))), "html", null, true);
            yield "\" class=\"rounded-circle\" width=\"50\" height=\"50\" alt=\"\">
                                                </div>
                                                <p class=\"mb-0\">";
            // line 1074
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "name", [], "any", false, false, false, 1074), "html", null, true);
            yield "</p>
                                            </div>
                                        </td>
                                        <td>";
            // line 1077
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "price", [], "any", false, false, false, 1077), "html", null, true);
            yield "</td>
                                        <td>";
            // line 1078
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "vendor", [], "any", false, false, false, 1078), "html", null, true);
            yield "</td>
                                        <td>
                                            ";
            // line 1080
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 1080) == "Completed")) {
                // line 1081
                yield "                                                <p class=\"dash-lable mb-0 bg-success bg-opacity-10 text-success rounded-2\">Completed</p>
                                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 1082
$context["order"], "status", [], "any", false, false, false, 1082) == "Pending")) {
                // line 1083
                yield "                                                <p class=\"dash-lable mb-0 bg-warning bg-opacity-10 text-warning rounded-2\">Pending</p>
                                            ";
            } else {
                // line 1085
                yield "                                                <p class=\"dash-lable mb-0 bg-danger bg-opacity-10 text-danger rounded-2\">Canceled</p>
                                            ";
            }
            // line 1087
            yield "                                        </td>
                                        <td>
                                            <div class=\"d-flex align-items-center gap-1\">
                                                <p class=\"mb-0\">";
            // line 1090
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "rating", [], "any", false, false, false, 1090), "html", null, true);
            yield "</p>
                                                <i class=\"material-icons-outlined text-warning fs-6\">star</i>
                                            </div>
                                        </td>
                                    </tr>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['order'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1096
        yield "                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Charts -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch mt-4\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div id=\"chart8\"></div>
                        <div class=\"d-flex align-items-center gap-3 mt-4\">
                            <div class=\"\">
                                <h1 class=\"mb-0\">36.7%</h1>
                            </div>
                            <div class=\"d-flex align-items-center align-self-end gap-2\">
                                <span class=\"material-icons-outlined text-success\">trending_up</span>
                                <p class=\"mb-0 text-success\">34.5%</p>
                            </div>
                        </div>
                        <p class=\"mb-4\">Visitors Growth</p>
                        <div class=\"d-flex flex-column gap-3\">
                            <div class=\"\">
                                <p class=\"mb-1\">Clicks <span class=\"float-end\">2589</span></p>
                                <div class=\"progress\" style=\"height: 5px;\">
                                    <div class=\"progress-bar bg-grd-primary\" style=\"width: 65%\"></div>
                                </div>
                            </div>
                            <div class=\"\">
                                <p class=\"mb-1\">Likes <span class=\"float-end\">6748</span></p>
                                <div class=\"progress\" style=\"height: 5px;\">
                                    <div class=\"progress-bar bg-grd-warning\" style=\"width: 55%\"></div>
                                </div>
                            </div>
                            <div class=\"\">
                                <p class=\"mb-1\">Upvotes <span class=\"float-end\">9842</span></p>
                                <div class=\"progress\" style=\"height: 5px;\">
                                    <div class=\"progress-bar bg-grd-info\" style=\"width: 45%\"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Accounts Chart -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch mt-4\">
                <div class=\"card rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-center gap-3 mb-2\">
                            <div class=\"\">
                                <h3 class=\"mb-0\">85,247</h3>
                            </div>
                            <div class=\"flex-grow-0\">
                                <p class=\"dash-lable d-flex align-items-center gap-1 rounded mb-0 bg-success text-success bg-opacity-10\">
                                    <span class=\"material-icons-outlined fs-6\">arrow_downward</span>23.7%
                                </p>
                            </div>
                        </div>
                        <p class=\"mb-0\">Total Accounts</p>
                        <div id=\"chart7\"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Close the second row -->
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 1268
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 1269
        yield "<!-- jQuery first (required by other scripts) -->
<script src=\"";
        // line 1270
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/js/jquery.min.js"), "html", null, true);
        yield "\"></script>

<!--bootstrap js-->
<script src=\"";
        // line 1273
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/js/bootstrap.bundle.min.js"), "html", null, true);
        yield "\"></script>

<!--plugins-->
<!--plugins-->
<script src=\"";
        // line 1277
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1278
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/metismenu/metisMenu.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1279
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/apexchart/apexcharts.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1280
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/simplebar/js/simplebar.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js\"></script>
<script src=\"";
        // line 1282
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/peity/jquery.peity.min.js"), "html", null, true);
        yield "\"></script>

<!-- Dashboard specific scripts -->
<script src=\"";
        // line 1285
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/js/main.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1286
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/js/dashboard1.js"), "html", null, true);
        yield "\"></script>

<script>
    \$(document).ready(function() {
        // Initialize peity charts with error handling
        if (typeof \$.fn.peity !== 'undefined') {
            \$(\".data-attributes span\").peity(\"donut\");
        } else {
            console.warn(\"Peity plugin not loaded\");
        }
        
        // Initialize Perfect Scrollbar for user list
        if (typeof PerfectScrollbar !== 'undefined') {
            const userList = document.querySelector(\".user-list\");
            if (userList) {
                new PerfectScrollbar(userList);
            }
        }
        
        // Initialize ApexCharts
        if (typeof ApexCharts !== 'undefined') {
            // Chart 1 - Active Users
            var options1 = {
                series: [{
                    name: \"Active Users\",
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }],
                chart: {
                    type: 'area',
                    height: 90,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart1 = new ApexCharts(document.querySelector(\"#chart1\"), options1);
            chart1.render();
            
            // Chart 2 - Total Users
            var options2 = {
                series: [{
                    name: \"Total Users\",
                    data: [31, 40, 28, 51, 42, 109, 100, 80, 95]
                }],
                chart: {
                    type: 'area',
                    height: 90,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#02c27a'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart2 = new ApexCharts(document.querySelector(\"#chart2\"), options2);
            chart2.render();
            
            // Chart 5 - Monthly Revenue
            var options5 = {
                series: [{
                    name: 'Revenue',
                    data: [31, 40, 28, 51, 42, 109, 100, 80, 95]
                }],
                chart: {
                    type: 'bar',
                    height: 200,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: { enabled: false },
                stroke: { show: true, width: 2, colors: ['#fff'] },
                fill: {
                    opacity: 1,
                    type: 'solid',
                    gradient: {
                        type: \"vertical\",
                        shadeIntensity: 0.5,
                        gradientToColors: ['#0d6efd', '#0d6efd'],
                        inverseColors: ['#0d6efd', '#0d6efd']
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart5 = new ApexCharts(document.querySelector(\"#chart5\"), options5);
            chart5.render();
            
            // Chart 6 - Device Type (Pie Chart)
            var options6 = {
                series: [35, 48, 27],
                chart: {
                    type: 'donut',
                    height: 200
                },
                labels: ['Desktop', 'Tablet', 'Mobile'],
                colors: ['#0d6efd', '#dc3545', '#198754'],
                legend: { show: false },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + \"%\"
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                name: {
                                    show: true
                                },
                                value: {
                                    show: true
                                }
                            }
                        }
                    }
                }
            };
            var chart6 = new ApexCharts(document.querySelector(\"#chart6\"), options6);
            chart6.render();
            
            // Chart 7 - Total Accounts
            var options7 = {
                series: [{
                    name: \"Accounts\",
                    data: [44, 55, 41, 67, 22, 43, 65, 59, 71, 62, 75, 81]
                }],
                chart: {
                    type: 'line',
                    height: 150,
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart7 = new ApexCharts(document.querySelector(\"#chart7\"), options7);
            chart7.render();
            
            // Chart 8 - Visitors Growth
            var options8 = {
                series: [{
                    name: \"Visitors\",
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 70, 74, 78]
                }],
                chart: {
                    type: 'area',
                    height: 200,
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart8 = new ApexCharts(document.querySelector(\"#chart8\"), options8);
            chart8.render();
        }
        
        // Theme switcher functionality
        \$('input[name=\"theme-options\"]').change(function() {
            const theme = \$(this).attr('id').toLowerCase().replace('theme', '-theme');
            \$('html').attr('data-bs-theme', theme);
            
            // Store theme preference in localStorage
            localStorage.setItem('dashboard-theme', theme);
        });
        
        // Load saved theme preference
        const savedTheme = localStorage.getItem('dashboard-theme');
        if (savedTheme) {
            \$('#staticBackdrop input[value=\"' + savedTheme + '\"]').prop('checked', true);
            \$('html').attr('data-bs-theme', savedTheme);
        }
        
        // Toggle sidebar
        \$('.btn-toggle').on('click', function() {
            \$('.sidebar-wrapper').toggleClass('active');
            \$('.overlay').toggleClass('active');
        });
        
        // Close sidebar when clicking overlay
        \$('.overlay').on('click', function() {
            \$(this).removeClass('active');
            \$('.sidebar-wrapper').removeClass('active');
        });
        
        // Close sidebar with close button
        \$('.sidebar-close').on('click', function() {
            \$('.sidebar-wrapper').removeClass('active');
            \$('.overlay').removeClass('active');
        });
        
        // User greeting based on time of day
        updateUserGreeting();
        
        function updateUserGreeting() {
            const hour = new Date().getHours();
            let greeting = \"Good \";
            
            if (hour < 12) greeting += \"Morning\";
            else if (hour < 18) greeting += \"Afternoon\";
            else greeting += \"Evening\";
            
            // Update welcome message if element exists
            const welcomeElement = \$('.fw-semibold:contains(\"Welcome back\")');
            if (welcomeElement.length) {
                welcomeElement.text(greeting + ',');
            }
        }
        
        // Delete order items from cart
        \$('.order-delete').on('click', function(e) {
            e.preventDefault();
            \$(this).closest('.order-item').fadeOut(300, function() {
                \$(this).remove();
                // Update order count
                const orderCount = \$('.order-item').length;
                \$('#offcanvasRightLabel').text(orderCount + ' New Orders');
                \$('.badge-notify').text(orderCount);
            });
        });
        
        // Initialize metismenu sidebar
        \$('#sidenav').metisMenu();
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Search functionality
        \$('.search-control, .mobile-search-control').on('input', function() {
            const searchTerm = \$(this).val().toLowerCase();
            if (searchTerm.length > 0) {
                \$('.search-popup').addClass('show');
            } else {
                \$('.search-popup').removeClass('show');
            }
        });
        
        \$('.search-close, .mobile-search-close').on('click', function() {
            \$('.search-popup').removeClass('show');
            \$('.search-control, .mobile-search-control').val('');
        });
        
        // Mobile search toggle
        \$('.mobile-search-btn').on('click', function() {
            \$('.search-popup').toggleClass('show');
        });
        
        // Notification close button
        \$('.notify-close').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            \$(this).closest('a').fadeOut(300, function() {
                \$(this).remove();
                // Update notification count
                const notifyCount = \$('.notify-list > div').length;
                \$('.badge-notify').first().text(notifyCount);
            });
        });
    });
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "dashboard/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  1819 => 1286,  1815 => 1285,  1809 => 1282,  1804 => 1280,  1800 => 1279,  1796 => 1278,  1792 => 1277,  1785 => 1273,  1779 => 1270,  1776 => 1269,  1763 => 1268,  1684 => 1096,  1672 => 1090,  1667 => 1087,  1663 => 1085,  1659 => 1083,  1657 => 1082,  1654 => 1081,  1652 => 1080,  1647 => 1078,  1643 => 1077,  1637 => 1074,  1632 => 1072,  1626 => 1068,  1622 => 1067,  1619 => 1066,  1617 => 1056,  1535 => 976,  1524 => 971,  1517 => 967,  1511 => 964,  1505 => 963,  1501 => 961,  1497 => 960,  1494 => 959,  1492 => 950,  1461 => 921,  1448 => 916,  1444 => 915,  1438 => 912,  1432 => 909,  1428 => 908,  1424 => 906,  1420 => 905,  1417 => 904,  1415 => 895,  1246 => 729,  1220 => 706,  1214 => 703,  1175 => 666,  1162 => 665,  1135 => 1652,  1099 => 1618,  1097 => 1268,  1089 => 1262,  1071 => 1258,  1067 => 1257,  1063 => 1256,  1055 => 1255,  1052 => 1254,  1035 => 1253,  1032 => 1252,  1030 => 1245,  1002 => 1220,  996 => 1216,  982 => 1208,  978 => 1207,  970 => 1204,  966 => 1202,  962 => 1201,  959 => 1200,  957 => 1190,  930 => 1165,  928 => 665,  910 => 650,  902 => 645,  898 => 644,  894 => 643,  890 => 642,  876 => 631,  872 => 630,  868 => 629,  854 => 618,  850 => 617,  846 => 616,  832 => 605,  828 => 604,  812 => 591,  803 => 585,  799 => 584,  795 => 583,  791 => 582,  777 => 571,  773 => 570,  769 => 569,  755 => 558,  751 => 557,  747 => 556,  733 => 545,  729 => 544,  725 => 543,  709 => 530,  693 => 517,  679 => 506,  673 => 503,  667 => 500,  663 => 499,  652 => 491,  644 => 485,  633 => 480,  629 => 479,  624 => 477,  620 => 475,  615 => 474,  613 => 465,  600 => 454,  590 => 450,  584 => 449,  580 => 447,  576 => 446,  564 => 436,  556 => 433,  538 => 432,  532 => 431,  528 => 429,  524 => 428,  517 => 424,  114 => 24,  110 => 23,  106 => 22,  102 => 21,  98 => 20,  94 => 19,  90 => 18,  84 => 15,  80 => 14,  76 => 13,  72 => 12,  68 => 11,  64 => 10,  60 => 9,  50 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Maxton | Bootstrap 5 Admin Dashboard Template</title>
    
    <!-- Load ALL CSS files from public/Back_Office/assets/ -->
    <link rel=\"icon\" href=\"{{ asset('Back_Office/assets/images/favicon-32x32.png') }}\" type=\"image/png\">
    <link href=\"{{ asset('Back_Office/assets/css/pace.min.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/assets/plugins/metismenu/metisMenu.min.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/assets/plugins/metismenu/mm-vertical.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/assets/plugins/simplebar/css/simplebar.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/assets/css/bootstrap.min.css') }}\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/assets/css/bootstrap-extended.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/sass/main.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/sass/dark-theme.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/sass/blue-theme.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/sass/semi-dark.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/sass/bordered-theme.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Back_Office/sass/responsive.css') }}\" rel=\"stylesheet\">
    
    <!-- Custom CSS Fixes -->
    <style>
        /* 1. Fix Search Bar */
        .header-search .search-input input {
            padding: 0.5rem 1rem 0.5rem 3rem !important;
            background-position: 1rem center !important;
            background-size: 20px 20px !important;
            height: 40px !important;
            font-size: 0.875rem !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 6px !important;
            width: 250px !important;
        }
        
        .header-search .search-input {
            position: relative;
        }
        
        .header-search .search-input .material-icons-outlined {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px !important;
            color: #6c757d;
        }
        
        /* 2. Fix Language Selector */
        .language-dropdown .btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            background: white;
            font-size: 0.875rem;
        }
        
        .language-dropdown .btn img {
            width: 20px;
            height: 20px;
            border-radius: 3px;
        }
        
        /* 3. Fix User Profile */
        .user-dropdown .btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            background: white;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .user-name {
            font-size: 0.875rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        /* 4. Fix Customize Button */
        .btn-customize {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background: #0d6efd;
            color: white;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .btn-customize:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        
        /* 5. Fix Performance Metrics Bar */
        .performance-metrics {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #212529;
            color: #adb5bd;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            z-index: 1030;
            border-top: 1px solid #495057;
        }
        
        .performance-metrics .d-flex {
            justify-content: space-between;
            align-items: center;
        }
        
        /* Cart Order Images with Fallback */
        .order-img {
            width: 75px;
            height: 75px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            overflow: hidden;
            position: relative;
        }
        
        .order-img img {
            object-fit: cover;
            border-radius: 12px;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .order-img img[src=\"\"], .order-img img:not([src]) {
            display: none;
        }
        
        .order-item {
            transition: all 0.2s ease;
        }
        
        .order-item:hover {
            background-color: #f8f9fa;
            transform: translateX(2px);
        }
        
        .order-delete {
            color: #6c757d;
            transition: color 0.2s ease;
        }
        
        .order-delete:hover {
            color: #dc3545;
        }
        
        /* 6. Fix Header Alignment */
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        /* 7. Ensure proper icon sizing */
        .material-icons-outlined {
            font-size: 20px !important;
            vertical-align: middle;
        }
        
        /* 8. Fix dropdown menus */
        .dropdown-menu {
        }
        
        .page-content {
            flex: 1;
            padding: 1rem;
            margin-top: 0;
        }
        
        /* 9. Dashboard welcome section height */
        .card.w-100.overflow-hidden.rounded-4 {
            min-height: 200px;
        }
        
        .welcome-back-img {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            height: 100%;
        }
        
        /* 10. Responsive fixes */
        @media (max-width: 768px) {
            .header-search .search-input input {
                width: 200px !important;
            }
            
            .language-dropdown .btn span,
            .user-dropdown .btn .user-name {
                display: none !important;
            }
            
            .header-right {
                gap: 0.5rem !important;
            }
        }
        
        @media (max-width: 1400px) {
            .col-xxl-4, .col-xxl-8, .col-xxl-2 {
                flex: 0 0 auto;
                width: 100%;
            }
        }
        
        /* 10. Fix header search icon positioning */
        .header-search .search-input {
            position: relative;
        }
        
        .header-search .search-input .material-icons-outlined {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 18px !important;
            color: #6c757d;
        }
        
        /* 11. Fix header overall styling */
        .header {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        /* 12. Fix dropdown arrows */
        .dropdown-toggle::after {
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            margin-left: 0.5rem;
        }
        
        /* 13. Fix notification badge */
        .badge-notify {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        /* 14. Fix apps dropdown grid */
        .apps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.5rem;
            padding: 0.5rem;
            min-width: 300px;
        }
        
        .app-item {
            text-align: center;
            padding: 0.5rem;
            border-radius: 6px;
            transition: background-color 0.2s;
        }
        
        .app-item:hover {
            background-color: #f8f9fa;
        }
        
        .app-item a {
            text-decoration: none;
            color: inherit;
            font-size: 0.75rem;
        }
        
        .app-item img {
            width: 32px;
            height: 32px;
            margin-bottom: 0.25rem;
        }
        
        /* 15. Fix notification items */
        .notify-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f3f5;
            transition: background-color 0.2s;
        }
        
        .notify-item:hover {
            background-color: #f8f9fa;
        }
        
        .notify-item:last-child {
            border-bottom: none;
        }
        
        /* 16. Fix metrics bar spacing */
        .metrics-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .metrics-right {
            font-weight: 500;
        }
        
        /* 17. Fix button hover states */
        .btn:hover {
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
        
        /* 18. Fix card shadows */
        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.2s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* 12. Simple background fix */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        .page-wrapper {
            background: transparent;
            min-height: 100vh;
        }
        
        .page-content {
            background: rgba(255, 255, 255, 0.95);
            margin: 0 1rem 1rem 1rem;
            border-radius: 1rem;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }
        
        /* Remove top spacing to reach navbar */
        .page-wrapper {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        
        /* Adjust breadcrumb area */
        .breadcrumb-area {
            padding-top: 1rem;
        }
    </style>
</head>
<body>

<!-- Start adding HTML chunks here -->

<!-- CHUNK A: HEADER WITH MEGA MENU, LANGUAGE, NOTIFICATIONS -->
<div class=\"header\">
    <div class=\"header-left\">
        <div class=\"menu-toggle\">
            <span class=\"material-icons-outlined\">menu</span>
        </div>
            </div>
    <div class=\"header-right\">
        <div class=\"header-search\">
            <div class=\"search-input\">
                <span class=\"material-icons-outlined\">search</span>
                <input type=\"text\" placeholder=\"Search...\">
            </div>
        </div>
        
        <!-- LANGUAGE DROPDOWN -->
        <div class=\"dropdown language-dropdown\">
            <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                <img src=\"{{ asset('Back_Office/assets/images/county/01.png') }}\" alt=\"Language\">
                <span>English</span>
            </button>
            <ul class=\"dropdown-menu\">
                {% for i in 1..8 %}
                <li>
                    <a class=\"dropdown-item\" href=\"#\">
                        <img src=\"{{ asset('Back_Office/assets/images/county/0' ~ i ~ '.png') }}\" alt=\"Language {{ i }}\">
                        {% if i == 1 %}English{% elseif i == 2 %}Spanish{% elseif i == 3 %}French{% elseif i == 4 %}German{% elseif i == 5 %}Italian{% elseif i == 6 %}Chinese{% elseif i == 7 %}Japanese{% elseif i == 8 %}Arabic{% endif %}
                    </a>
                </li>
                {% endfor %}
            </ul>
        </div>
        
        <!-- APPS DROPDOWN -->
        <div class=\"dropdown apps-dropdown\">
            <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                <span class=\"material-icons-outlined\">apps</span>
            </button>
            <div class=\"dropdown-menu dropdown-menu-end\">
                <div class=\"apps-grid\">
                    {% for i in 1..12 %}
                    <div class=\"app-item\">
                        <a href=\"#\">
                            <img src=\"{{ asset('Back_Office/assets/images/apps/' ~ (i < 10 ? '0' ~ i : i) ~ '.png') }}\" alt=\"App {{ i }}\">
                            <span>App {{ i }}</span>
                        </a>
                    </div>
                    {% endfor %}
                </div>
            </div>
        </div>
        
        <!-- NOTIFICATIONS DROPDOWN -->
        <div class=\"dropdown notifications-dropdown\">
            <button class=\"btn dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                <span class=\"material-icons-outlined\">notifications</span>
                <span class=\"badge\">7</span>
            </button>
            <ul class=\"dropdown-menu dropdown-menu-end\">
                {% set notifications = [
                    {icon: 'mail', text: 'New email received', time: '5 min ago'},
                    {icon: 'person', text: 'New user registered', time: '10 min ago'},
                    {icon: 'shopping_cart', text: 'New order placed', time: '15 min ago'},
                    {icon: 'message', text: 'New message received', time: '20 min ago'},
                    {icon: 'star', text: 'New review posted', time: '25 min ago'},
                    {icon: 'warning', text: 'System warning', time: '30 min ago'},
                    {icon: 'info', text: 'System update available', time: '1 hour ago'}
                ] %}
                {% for notification in notifications %}
                <li>
                    <a class=\"dropdown-item\" href=\"#\">
                        <span class=\"material-icons-outlined\">{{ notification.icon }}</span>
                        <div class=\"notification-content\">
                            <p>{{ notification.text }}</p>
                            <span class=\"time\">{{ notification.time }}</span>
                        </div>
                    </a>
                </li>
                {% endfor %}
                <li><hr class=\"dropdown-divider\"></li>
                <li><a class=\"dropdown-item\" href=\"#\">View all notifications</a></li>
            </ul>
        </div>
        
        <!-- GO TO FRONT BUTTON -->
        <a href=\"{{ path('app_homepage') }}\" class=\"btn btn-primary btn-sm\">
            <span class=\"material-icons-outlined\">home</span>
            Go to Front
        </a>
        
        <!-- USER PROFILE -->
        <div class=\"dropdown user-dropdown\">
            <button class=\"btn dropdown-toggle d-flex align-items-center\" type=\"button\" data-bs-toggle=\"dropdown\">
                <img src=\"{{ asset('Back_Office/assets/images/avatars/01.png') }}\" alt=\"User\" class=\"user-avatar\">
                <span class=\"user-name\">{{ app.user ? app.user.email : 'Admin User' }}</span>
            </button>
            <ul class=\"dropdown-menu dropdown-menu-end\">
                <li><a class=\"dropdown-item\" href=\"{{ path('app_profile') }}\"><span class=\"material-icons-outlined\">person</span> Profile</a></li>
                <li><a class=\"dropdown-item\" href=\"#\"><span class=\"material-icons-outlined\">settings</span> Settings</a></li>
                <li><hr class=\"dropdown-divider\"></li>
                <li><a class=\"dropdown-item\" href=\"{{ path('app_logout') }}\"><span class=\"material-icons-outlined\">logout</span> Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- CHUNK B: COMPLETE SIDEBAR -->
<!--start sidebar-->
<aside class=\"sidebar-wrapper\" data-simplebar=\"true\">
    <div class=\"sidebar-header\">
        <div class=\"logo-icon\">
            <img src=\"{{ asset('Back_Office/assets/images/logo-icon.png') }}\" class=\"logo-img\" alt=\"\">
        </div>
        <div class=\"logo-name flex-grow-1\">
            <h5 class=\"mb-0\">Maxton</h5>
        </div>
        <div class=\"sidebar-close\">
            <span class=\"material-icons-outlined\">close</span>
        </div>
    </div>
    <div class=\"sidebar-nav\">
        <!--navigation-->
        <ul class=\"metismenu\" id=\"sidenav\">
            <li>
                <a href=\"{{ path('dashboard_index') }}\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">home</i></div>
                    <div class=\"menu-title\">Dashboard</div>
                </a>
            </li>
            
            <li class=\"menu-label\">Users Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">people</i></div>
                    <div class=\"menu-title\">Users</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('user_datatable') }}\"><i class=\"material-icons-outlined\">arrow_right</i>All Users</a></li>
                    <li><a href=\"{{ path('user_add') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Add New User</a></li>
                    <li><a href=\"{{ path('user_roles') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Roles & Permissions</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Courses Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">school</i></div>
                    <div class=\"menu-title\">Courses</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('course_datatable') }}\"><i class=\"material-icons-outlined\">arrow_right</i>All Courses</a></li>
                    <li><a href=\"{{ path('add_course') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Add Course</a></li>
                    <li><a href=\"{{ path('course_categories') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Categories</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Quizzes Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">quiz</i></div>
                    <div class=\"menu-title\">Quizzes</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('quizz_datatable') }}\"><i class=\"material-icons-outlined\">arrow_right</i>All Quizzes</a></li>
                    <li><a href=\"{{ path('add_quizz') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Add Quiz</a></li>
                    <li><a href=\"{{ path('quizz_results') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Results</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Content Management</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">article</i></div>
                    <div class=\"menu-title\">Posts & Events</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('add_post') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Add Post</a></li>
                    <li><a href=\"{{ path('add_event') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Add Event</a></li>
                    <li><a href=\"{{ path('feed_datatable') }}\"><i class=\"material-icons-outlined\">arrow_right</i>All Feeds</a></li>
                    <li><a href=\"{{ path('event_datatable') }}\"><i class=\"material-icons-outlined\">arrow_right</i>All Events</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">User Management</li>
            <li>
                <a href=\"{{ path('dashboard_users_add') }}\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">people</i></div>
                    <div class=\"menu-title\">User Management</div>
                </a>
            </li>
            
            <li class=\"menu-label\">Orders & E-commerce</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">shopping_cart</i></div>
                    <div class=\"menu-title\">Orders</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('ecommerce_orders') }}\"><i class=\"material-icons-outlined\">arrow_right</i>All Orders</a></li>
                    <li><a href=\"{{ path('ecommerce_products') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Products</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Support</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">support_agent</i></div>
                    <div class=\"menu-title\">Support</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('reclamation_datatable') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Reclamations</a></li>
                    <li><a href=\"{{ path('support_tickets') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Tickets</a></li>
                    <li><a href=\"{{ path('faq_management') }}\"><i class=\"material-icons-outlined\">arrow_right</i>FAQ</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Reports & Analytics</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">analytics</i></div>
                    <div class=\"menu-title\">Reports</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('reports_sales') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Sales Reports</a></li>
                    <li><a href=\"{{ path('reports_users') }}\"><i class=\"material-icons-outlined\">arrow_right</i>User Reports</a></li>
                    <li><a href=\"{{ path('reports_courses') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Course Reports</a></li>
                </ul>
            </li>
            
            <li class=\"menu-label\">Settings</li>
            <li>
                <a class=\"has-arrow\" href=\"javascript:;\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">settings</i></div>
                    <div class=\"menu-title\">Settings</div>
                </a>
                <ul>
                    <li><a href=\"{{ path('settings_general') }}\"><i class=\"material-icons-outlined\">arrow_right</i>General Settings</a></li>
                    <li><a href=\"{{ path('settings_security') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Security</a></li>
                    <li><a href=\"{{ path('settings_notifications') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Notifications</a></li>
                    <li><a href=\"{{ path('settings_theme') }}\"><i class=\"material-icons-outlined\">arrow_right</i>Theme Settings</a></li>
                </ul>
            </li>
            
            <li>
                <a href=\"{{ path('app_logout') }}\">
                    <div class=\"parent-icon\"><i class=\"material-icons-outlined\">logout</i></div>
                    <div class=\"menu-title\">Logout</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->

<!-- CHUNK C PART 1: MAIN CONTENT -->
<!--start main wrapper-->
<main class=\"main-wrapper\">
    <div class=\"main-content\">
        {% block page_content %}
        <!--breadcrumb-->
        <div class=\"page-breadcrumb d-none d-sm-flex align-items-center mb-3\">
            <div class=\"breadcrumb-title pe-3\">Dashboard</div>
            <div class=\"ps-3\">
                <nav aria-label=\"breadcrumb\">
                    <ol class=\"breadcrumb mb-0 p-0\">
                        <li class=\"breadcrumb-item\"><a href=\"javascript:;\"><i class=\"bx bx-home-alt\"></i></a></li>
                        <li class=\"breadcrumb-item active\" aria-current=\"page\">Analysis</li>
                    </ol>
                </nav>
            </div>
            <div class=\"ms-auto\">
                <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-outline-primary\">Settings</button>
                    <button type=\"button\" class=\"btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split\" data-bs-toggle=\"dropdown\">
                        <span class=\"visually-hidden\">Toggle Dropdown</span>
                    </button>
                    <div class=\"dropdown-menu dropdown-menu-right dropdown-menu-lg-end\">
                        <a class=\"dropdown-item\" href=\"javascript:;\">Action</a>
                        <a class=\"dropdown-item\" href=\"javascript:;\">Another action</a>
                        <a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a>
                        <div class=\"dropdown-divider\"></div>
                        <a class=\"dropdown-item\" href=\"javascript:;\">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
     
        <div class=\"row\">
            <!-- Welcome Card -->
            <div class=\"col-xxl-8 d-flex align-items-stretch\">
                <div class=\"card w-100 overflow-hidden rounded-4\">
                    <div class=\"card-body position-relative p-4\">
                        <div class=\"row\">
                            <div class=\"col-12 col-sm-7\">
                                <div class=\"d-flex align-items-center gap-3 mb-5\">
                                    <img src=\"{{ asset('Back_Office/assets/images/avatars/01.png') }}\" class=\"rounded-circle bg-grd-info p-1\" width=\"60\" height=\"60\" alt=\"user\">
                                    <div class=\"\">
                                        <p class=\"mb-0 fw-semibold\">Welcome back</p>
                                        <h4 class=\"fw-semibold mb-0 fs-4 mb-0\">{{ app.user ? (app.user.firstName ~ ' ' ~ app.user.lastName)|trim : 'Admin' }}!</h4>
                                    </div>
                                </div>
                                <div class=\"d-flex align-items-center gap-5\">
                                    <div class=\"\">
                                        <h4 class=\"mb-1 fw-semibold d-flex align-content-center\">\$65.4K<i class=\"ti ti-arrow-up-right fs-5 lh-base text-success\"></i></h4>
                                        <p class=\"mb-3\">Today's Sales</p>
                                        <div class=\"progress mb-0\" style=\"height:5px;\">
                                            <div class=\"progress-bar bg-grd-success\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                        </div>
                                    </div>
                                    <div class=\"vr\"></div>
                                    <div class=\"\">
                                        <h4 class=\"mb-1 fw-semibold d-flex align-content-center\">78.4%<i class=\"ti ti-arrow-up-right fs-5 lh-base text-success\"></i></h4>
                                        <p class=\"mb-3\">Growth Rate</p>
                                        <div class=\"progress mb-0\" style=\"height:5px;\">
                                            <div class=\"progress-bar bg-grd-danger\" role=\"progressbar\" style=\"width: 60%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-12 col-sm-5\">
                                <div class=\"welcome-back-img pt-4\">
                                    <img src=\"{{ asset('Back_Office/assets/images/gallery/welcome-back-3.png') }}\" height=\"180\" alt=\"\">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Widgets -->
            <div class=\"col-xl-6 col-xxl-2 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-1\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">42.5K</h5>
                                <p class=\"mb-0\">Active Users</p>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"chart-container2\">
                            <div id=\"chart1\"></div>
                        </div>
                        <div class=\"text-center\">
                            <p class=\"mb-0 font-12\">24K users increased from last month</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"col-xl-6 col-xxl-2 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">97.4K</h5>
                                <p class=\"mb-0\">Total Users</p>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"chart-container2\">
                            <div id=\"chart2\"></div>
                        </div>
                        <div class=\"text-center\">
                            <p class=\"mb-0 font-12\"><span class=\"text-success me-1\">12.5%</span> from last month</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Chart -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"text-center\">
                            <h6 class=\"mb-0\">Monthly Revenue</h6>
                        </div>
                        <div class=\"mt-4\" id=\"chart5\"></div>
                        <p>Average monthly sale for every author</p>
                        <div class=\"d-flex align-items-center gap-3 mt-4\">
                            <div class=\"\">
                                <h1 class=\"mb-0 text-primary\">68.9%</h1>
                            </div>
                            <div class=\"d-flex align-items-center align-self-end\">
                                <p class=\"mb-0 text-success\">34.5%</p>
                                <span class=\"material-icons-outlined text-success\">expand_less</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Device Type Chart -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">Device Type</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=\"position-relative\">
                            <div class=\"piechart-legend\">
                                <h2 class=\"mb-1\">68%</h2>
                                <h6 class=\"mb-0\">Total Views</h6>
                            </div>
                            <div id=\"chart6\"></div>
                        </div>
                        <div class=\"d-flex flex-column gap-3\">
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <p class=\"mb-0 d-flex align-items-center gap-2 w-25\">
                                    <span class=\"material-icons-outlined fs-6 text-primary\">desktop_windows</span>Desktop
                                </p>
                                <div class=\"\">
                                    <p class=\"mb-0\">35%</p>
                                </div>
                            </div>
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <p class=\"mb-0 d-flex align-items-center gap-2 w-25\">
                                    <span class=\"material-icons-outlined fs-6 text-danger\">tablet_mac</span>Tablet
                                </p>
                                <div class=\"\">
                                    <p class=\"mb-0\">48%</p>
                                </div>
                            </div>
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <p class=\"mb-0 d-flex align-items-center gap-2 w-25\">
                                    <span class=\"material-icons-outlined fs-6 text-success\">phone_android</span>Mobile
                                </p>
                                <div class=\"\">
                                    <p class=\"mb-0\">27%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Campaign Stats -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h6 class=\"mb-0 fw-bold\">Campaign Stats</h6>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>

                        <ul class=\"list-group list-group-flush\">
                            {% set campaignStats = [
                                {icon: 'calendar_today', bg: 'grd-primary', title: 'Campaigns', value: '54', percent: '28%', color: 'success'},
                                {icon: 'email', bg: 'grd-success', title: 'Emailed', value: '245', percent: '15%', color: 'danger'},
                                {icon: 'open_in_new', bg: 'grd-branding', title: 'Opened', value: '54', percent: '30.5%', color: 'success'},
                                {icon: 'ads_click', bg: 'grd-warning', title: 'Clicked', value: '859', percent: '34.6%', color: 'danger'},
                                {icon: 'subscriptions', bg: 'grd-info', title: 'Subscribed', value: '24,758', percent: '53%', color: 'success'},
                                {icon: 'inbox', bg: 'grd-danger', title: 'Spam Message', value: '548', percent: '47%', color: 'danger'},
                                {icon: 'visibility', bg: 'grd-deep-blue', title: 'Views Mails', value: '9845', percent: '68%', color: 'success'}
                            ] %}
                            
                            {% for stat in campaignStats %}
                            <li class=\"list-group-item px-0 bg-transparent\">
                                <div class=\"d-flex align-items-center gap-3\">
                                    <div class=\"wh-42 d-flex align-items-center justify-content-center rounded-3 bg-{{ stat.bg }}\">
                                        <span class=\"material-icons-outlined text-white\">{{ stat.icon }}</span>
                                    </div>
                                    <div class=\"flex-grow-1\">
                                        <h6 class=\"mb-0\">{{ stat.title }}</h6>
                                    </div>
                                    <div class=\"d-flex align-items-center gap-3\">
                                        <p class=\"mb-0\">{{ stat.value }}</p>
                                        <p class=\"mb-0 fw-bold text-{{ stat.color }}\">{{ stat.percent }}</p>
                                    </div>
                                </div>
                            </li>
                            {% endfor %}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Close the first row -->

        <div class=\"row mt-4\">
            <!-- Social Leads -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0 fw-bold\">Social Leads</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class=\"d-flex flex-column justify-content-between gap-4\">
                            {% set socialLeads = [
                                {img: '17.png', name: 'Facebook', percent: '55%', color: '#0d6efd'},
                                {img: '18.png', name: 'LinkedIn', percent: '67%', color: '#fc185a'},
                                {img: '19.png', name: 'Instagram', percent: '78%', color: '#02c27a'},
                                {img: '20.png', name: 'Snapchat', percent: '46%', color: '#fd7e14'},
                                {img: '05.png', name: 'Google', percent: '38%', color: '#0dcaf0'},
                                {img: '08.png', name: 'Altaba', percent: '15%', color: '#6f42c1'},
                                {img: '07.png', name: 'Spotify', percent: '12%', color: '#ff00b3'}
                            ] %}
                            
                            {% for social in socialLeads %}
                            <div class=\"d-flex align-items-center gap-4\">
                                <div class=\"d-flex align-items-center gap-3 flex-grow-1\">
                                    <img src=\"{{ asset('Back_Office/assets/images/apps/' ~ social.img) }}\" width=\"32\" alt=\"{{ social.name }}\">
                                    <p class=\"mb-0\">{{ social.name }}</p>
                                </div>
                                <div class=\"\">
                                    <p class=\"mb-0 fs-6\">{{ social.percent }}</p>
                                </div>
                                <div class=\"\">
                                    <p class=\"mb-0 data-attributes\">
                                        <span data-peity='{ \"fill\": [\"{{ social.color }}\", \"rgb(255 255 255 / 10%)\"], \"innerRadius\": 14, \"radius\": 18 }'>5/7</span>
                                    </p>
                                </div>
                            </div>
                            {% endfor %}
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Users List -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-header border-0 p-3 border-bottom\">
                        <div class=\"d-flex align-items-start justify-content-between\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">New Users</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=\"card-body p-0\">
                        <div class=\"user-list p-3\">
                            <div class=\"d-flex flex-column gap-3\">
                                                            </div>
                        </div>
                    </div>
                    <div class=\"card-footer bg-transparent p-3\">
                        <div class=\"d-flex align-items-center justify-content-between gap-3\">
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">share</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">textsms</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">email</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">attach_file</i></a>
                            <a href=\"javascript:;\" class=\"sharelink\"><i class=\"material-icons-outlined\">event</i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class=\"col-lg-12 col-xxl-8 d-flex align-items-stretch\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-start justify-content-between mb-3\">
                            <div class=\"\">
                                <h5 class=\"mb-0\">Recent Orders</h5>
                            </div>
                            <div class=\"dropdown\">
                                <a href=\"javascript:;\" class=\"dropdown-toggle-nocaret options dropdown-toggle\" data-bs-toggle=\"dropdown\">
                                    <span class=\"material-icons-outlined fs-5\">more_vert</span>
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Another action</a></li>
                                    <li><a class=\"dropdown-item\" href=\"javascript:;\">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class=\"order-search position-relative my-3\">
                            <input class=\"form-control rounded-5 px-5\" type=\"text\" placeholder=\"Search\">
                            <span class=\"material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50\">search</span>
                        </div>
                        
                        <div class=\"table-responsive\">
                            <table class=\"table align-middle\">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Amount</th>
                                        <th>Vendor</th>
                                        <th>Status</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% set recentOrders = [
                                        {img: '01.png', name: 'Sports Shoes', price: '\$289', vendor: 'Nike Store', status: 'Completed', rating: '4.5'},
                                        {img: '02.png', name: 'Red Airpods', price: '\$149', vendor: 'Apple Store', status: 'Pending', rating: '4.8'},
                                        {img: '03.png', name: 'Men Polo Tshirt', price: '\$139', vendor: 'Fashion Hub', status: 'Completed', rating: '4.2'},
                                        {img: '04.png', name: 'Blue Jeans Casual', price: '\$485', vendor: 'Denim Co', status: 'Pending', rating: '4.0'},
                                        {img: '05.png', name: 'Fancy Shirts', price: '\$758', vendor: 'Premium Wear', status: 'Completed', rating: '4.7'},
                                        {img: '06.png', name: 'Home Sofa Set', price: '\$546', vendor: 'Furniture Plus', status: 'Canceled', rating: '3.8'},
                                        {img: '07.png', name: 'Black iPhone', price: '\$1049', vendor: 'Tech World', status: 'Completed', rating: '4.9'},
                                        {img: '08.png', name: 'Goldan Watch', price: '\$689', vendor: 'Watch Gallery', status: 'Pending', rating: '4.3'}
                                    ] %}
                                    
                                    {% for order in recentOrders %}
                                    <tr>
                                        <td>
                                            <div class=\"d-flex align-items-center gap-3\">
                                                <div class=\"\">
                                                    <img src=\"{{ asset('Back_Office/assets/images/top-products/' ~ order.img) }}\" class=\"rounded-circle\" width=\"50\" height=\"50\" alt=\"\">
                                                </div>
                                                <p class=\"mb-0\">{{ order.name }}</p>
                                            </div>
                                        </td>
                                        <td>{{ order.price }}</td>
                                        <td>{{ order.vendor }}</td>
                                        <td>
                                            {% if order.status == 'Completed' %}
                                                <p class=\"dash-lable mb-0 bg-success bg-opacity-10 text-success rounded-2\">Completed</p>
                                            {% elseif order.status == 'Pending' %}
                                                <p class=\"dash-lable mb-0 bg-warning bg-opacity-10 text-warning rounded-2\">Pending</p>
                                            {% else %}
                                                <p class=\"dash-lable mb-0 bg-danger bg-opacity-10 text-danger rounded-2\">Canceled</p>
                                            {% endif %}
                                        </td>
                                        <td>
                                            <div class=\"d-flex align-items-center gap-1\">
                                                <p class=\"mb-0\">{{ order.rating }}</p>
                                                <i class=\"material-icons-outlined text-warning fs-6\">star</i>
                                            </div>
                                        </td>
                                    </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Charts -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch mt-4\">
                <div class=\"card w-100 rounded-4\">
                    <div class=\"card-body\">
                        <div id=\"chart8\"></div>
                        <div class=\"d-flex align-items-center gap-3 mt-4\">
                            <div class=\"\">
                                <h1 class=\"mb-0\">36.7%</h1>
                            </div>
                            <div class=\"d-flex align-items-center align-self-end gap-2\">
                                <span class=\"material-icons-outlined text-success\">trending_up</span>
                                <p class=\"mb-0 text-success\">34.5%</p>
                            </div>
                        </div>
                        <p class=\"mb-4\">Visitors Growth</p>
                        <div class=\"d-flex flex-column gap-3\">
                            <div class=\"\">
                                <p class=\"mb-1\">Clicks <span class=\"float-end\">2589</span></p>
                                <div class=\"progress\" style=\"height: 5px;\">
                                    <div class=\"progress-bar bg-grd-primary\" style=\"width: 65%\"></div>
                                </div>
                            </div>
                            <div class=\"\">
                                <p class=\"mb-1\">Likes <span class=\"float-end\">6748</span></p>
                                <div class=\"progress\" style=\"height: 5px;\">
                                    <div class=\"progress-bar bg-grd-warning\" style=\"width: 55%\"></div>
                                </div>
                            </div>
                            <div class=\"\">
                                <p class=\"mb-1\">Upvotes <span class=\"float-end\">9842</span></p>
                                <div class=\"progress\" style=\"height: 5px;\">
                                    <div class=\"progress-bar bg-grd-info\" style=\"width: 45%\"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Accounts Chart -->
            <div class=\"col-xl-6 col-xxl-4 d-flex align-items-stretch mt-4\">
                <div class=\"card rounded-4\">
                    <div class=\"card-body\">
                        <div class=\"d-flex align-items-center gap-3 mb-2\">
                            <div class=\"\">
                                <h3 class=\"mb-0\">85,247</h3>
                            </div>
                            <div class=\"flex-grow-0\">
                                <p class=\"dash-lable d-flex align-items-center gap-1 rounded mb-0 bg-success text-success bg-opacity-10\">
                                    <span class=\"material-icons-outlined fs-6\">arrow_downward</span>23.7%
                                </p>
                            </div>
                        </div>
                        <p class=\"mb-0\">Total Accounts</p>
                        <div id=\"chart7\"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Close the second row -->
        {% endblock page_content %}
    </div>
    <!-- Close main-content div -->
</main>
<!--end main wrapper-->

<!--start overlay-->
<div class=\"overlay btn-toggle\"></div>
<!--end overlay-->

<!--start footer-->
<footer class=\"page-footer\">
    <p class=\"mb-0\">Copyright  2023. All right reserved.</p>
</footer>
<!--end footer-->

<!--start cart-->
<div class=\"offcanvas offcanvas-end\" tabindex=\"-1\" id=\"offcanvasCart\">
    <div class=\"offcanvas-header border-bottom h-70\">
        <h5 class=\"mb-0\" id=\"offcanvasRightLabel\">8 New Orders</h5>
        <a href=\"javascript:;\" class=\"primaery-menu-close\" data-bs-dismiss=\"offcanvas\">
            <i class=\"material-icons-outlined\">close</i>
        </a>
    </div>
    <div class=\"offcanvas-body p-0\">
        <div class=\"order-list\">
            {% set cartOrders = [
                {img: '01.png', title: 'White Men Shoes', price: '\$289'},
                {img: '02.png', title: 'Red Airpods', price: '\$149'},
                {img: '03.png', title: 'Men Polo Tshirt', price: '\$139'},
                {img: '04.png', title: 'Blue Jeans Casual', price: '\$485'},
                {img: '05.png', title: 'Fancy Shirts', price: '\$758'},
                {img: '06.png', title: 'Home Sofa Set', price: '\$546'},
                {img: '07.png', title: 'Black iPhone', price: '\$1049'},
                {img: '08.png', title: 'Goldan Watch', price: '\$689'}
            ] %}
            
            {% for order in cartOrders %}
            <div class=\"order-item d-flex align-items-center gap-3 p-3 border-bottom\">
                <div class=\"order-img\">
                    <img src=\"{{ asset('Back_Office/assets/images/orders/' ~ order.img) }}\" class=\"img-fluid rounded-3\" width=\"75\" alt=\"{{ order.title }}\" loading=\"lazy\">
                </div>
                <div class=\"order-info flex-grow-1\">
                    <h5 class=\"mb-1 order-title\">{{ order.title }}</h5>
                    <p class=\"mb-0 order-price\">{{ order.price }}</p>
                </div>
                <div class=\"d-flex\">
                    <a class=\"order-delete\" href=\"javascript:;\"><span class=\"material-icons-outlined\">delete</span></a>
                    <a class=\"order-delete\" href=\"javascript:;\"><span class=\"material-icons-outlined\">visibility</span></a>
                </div>
            </div>
            {% endfor %}
        </div>
    </div>
    <div class=\"offcanvas-footer h-70 p-3 border-top\">
        <div class=\"d-grid\">
            <a href=\"{{ path('ecommerce_orders') }}\" class=\"btn btn-grd btn-grd-primary\">View All Orders</a>
        </div>
    </div>
</div>
<!--end cart-->

<!--start switcher-->
<button class=\"btn btn-grd btn-grd-primary position-fixed bottom-0 end-0 m-3 d-flex align-items-center gap-2\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#staticBackdrop\">
    <i class=\"material-icons-outlined\">tune</i>Customize
</button>

<div class=\"offcanvas offcanvas-end\" data-bs-scroll=\"true\" tabindex=\"-1\" id=\"staticBackdrop\">
    <div class=\"offcanvas-header border-bottom h-70\">
        <div class=\"\">
            <h5 class=\"mb-0\">Theme Customizer</h5>
            <p class=\"mb-0\">Customize your theme</p>
        </div>
        <a href=\"javascript:;\" class=\"primaery-menu-close\" data-bs-dismiss=\"offcanvas\">
            <i class=\"material-icons-outlined\">close</i>
        </a>
    </div>
    <div class=\"offcanvas-body\">
        <div>
            <p>Theme variation</p>
            <div class=\"row g-3\">
                {% set themes = [
                    {id: 'BlueTheme', icon: 'contactless', label: 'Blue'},
                    {id: 'LightTheme', icon: 'light_mode', label: 'Light'},
                    {id: 'DarkTheme', icon: 'dark_mode', label: 'Dark'},
                    {id: 'SemiDarkTheme', icon: 'contrast', label: 'Semi Dark'},
                    {id: 'BoderedTheme', icon: 'border_style', label: 'Bordered'}
                ] %}
                
                {% for theme in themes %}
                <div class=\"col-12 col-xl-6\">
                    <input type=\"radio\" class=\"btn-check\" name=\"theme-options\" id=\"{{ theme.id }}\" {% if loop.first %}checked{% endif %}>
                    <label class=\"btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4\" for=\"{{ theme.id }}\">
                        <span class=\"material-icons-outlined\">{{ theme.icon }}</span>
                        <span>{{ theme.label }}</span>
                    </label>
                </div>
                {% endfor %}
            </div>
        </div>
    </div>
</div>
<!--end switcher-->

{% block javascripts %}
<!-- jQuery first (required by other scripts) -->
<script src=\"{{ asset('Back_Office/assets/js/jquery.min.js') }}\"></script>

<!--bootstrap js-->
<script src=\"{{ asset('Back_Office/assets/js/bootstrap.bundle.min.js') }}\"></script>

<!--plugins-->
<!--plugins-->
<script src=\"{{ asset('Back_Office/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}\"></script>
<script src=\"{{ asset('Back_Office/assets/plugins/metismenu/metisMenu.min.js') }}\"></script>
<script src=\"{{ asset('Back_Office/assets/plugins/apexchart/apexcharts.min.js') }}\"></script>
<script src=\"{{ asset('Back_Office/assets/plugins/simplebar/js/simplebar.min.js') }}\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js\"></script>
<script src=\"{{ asset('Back_Office/assets/plugins/peity/jquery.peity.min.js') }}\"></script>

<!-- Dashboard specific scripts -->
<script src=\"{{ asset('Back_Office/assets/js/main.js') }}\"></script>
<script src=\"{{ asset('Back_Office/assets/js/dashboard1.js') }}\"></script>

<script>
    \$(document).ready(function() {
        // Initialize peity charts with error handling
        if (typeof \$.fn.peity !== 'undefined') {
            \$(\".data-attributes span\").peity(\"donut\");
        } else {
            console.warn(\"Peity plugin not loaded\");
        }
        
        // Initialize Perfect Scrollbar for user list
        if (typeof PerfectScrollbar !== 'undefined') {
            const userList = document.querySelector(\".user-list\");
            if (userList) {
                new PerfectScrollbar(userList);
            }
        }
        
        // Initialize ApexCharts
        if (typeof ApexCharts !== 'undefined') {
            // Chart 1 - Active Users
            var options1 = {
                series: [{
                    name: \"Active Users\",
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }],
                chart: {
                    type: 'area',
                    height: 90,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart1 = new ApexCharts(document.querySelector(\"#chart1\"), options1);
            chart1.render();
            
            // Chart 2 - Total Users
            var options2 = {
                series: [{
                    name: \"Total Users\",
                    data: [31, 40, 28, 51, 42, 109, 100, 80, 95]
                }],
                chart: {
                    type: 'area',
                    height: 90,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#02c27a'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart2 = new ApexCharts(document.querySelector(\"#chart2\"), options2);
            chart2.render();
            
            // Chart 5 - Monthly Revenue
            var options5 = {
                series: [{
                    name: 'Revenue',
                    data: [31, 40, 28, 51, 42, 109, 100, 80, 95]
                }],
                chart: {
                    type: 'bar',
                    height: 200,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: { enabled: false },
                stroke: { show: true, width: 2, colors: ['#fff'] },
                fill: {
                    opacity: 1,
                    type: 'solid',
                    gradient: {
                        type: \"vertical\",
                        shadeIntensity: 0.5,
                        gradientToColors: ['#0d6efd', '#0d6efd'],
                        inverseColors: ['#0d6efd', '#0d6efd']
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart5 = new ApexCharts(document.querySelector(\"#chart5\"), options5);
            chart5.render();
            
            // Chart 6 - Device Type (Pie Chart)
            var options6 = {
                series: [35, 48, 27],
                chart: {
                    type: 'donut',
                    height: 200
                },
                labels: ['Desktop', 'Tablet', 'Mobile'],
                colors: ['#0d6efd', '#dc3545', '#198754'],
                legend: { show: false },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + \"%\"
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                name: {
                                    show: true
                                },
                                value: {
                                    show: true
                                }
                            }
                        }
                    }
                }
            };
            var chart6 = new ApexCharts(document.querySelector(\"#chart6\"), options6);
            chart6.render();
            
            // Chart 7 - Total Accounts
            var options7 = {
                series: [{
                    name: \"Accounts\",
                    data: [44, 55, 41, 67, 22, 43, 65, 59, 71, 62, 75, 81]
                }],
                chart: {
                    type: 'line',
                    height: 150,
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart7 = new ApexCharts(document.querySelector(\"#chart7\"), options7);
            chart7.render();
            
            // Chart 8 - Visitors Growth
            var options8 = {
                series: [{
                    name: \"Visitors\",
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 70, 74, 78]
                }],
                chart: {
                    type: 'area',
                    height: 200,
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#0d6efd'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: { show: false }
                },
                yaxis: { show: false }
            };
            var chart8 = new ApexCharts(document.querySelector(\"#chart8\"), options8);
            chart8.render();
        }
        
        // Theme switcher functionality
        \$('input[name=\"theme-options\"]').change(function() {
            const theme = \$(this).attr('id').toLowerCase().replace('theme', '-theme');
            \$('html').attr('data-bs-theme', theme);
            
            // Store theme preference in localStorage
            localStorage.setItem('dashboard-theme', theme);
        });
        
        // Load saved theme preference
        const savedTheme = localStorage.getItem('dashboard-theme');
        if (savedTheme) {
            \$('#staticBackdrop input[value=\"' + savedTheme + '\"]').prop('checked', true);
            \$('html').attr('data-bs-theme', savedTheme);
        }
        
        // Toggle sidebar
        \$('.btn-toggle').on('click', function() {
            \$('.sidebar-wrapper').toggleClass('active');
            \$('.overlay').toggleClass('active');
        });
        
        // Close sidebar when clicking overlay
        \$('.overlay').on('click', function() {
            \$(this).removeClass('active');
            \$('.sidebar-wrapper').removeClass('active');
        });
        
        // Close sidebar with close button
        \$('.sidebar-close').on('click', function() {
            \$('.sidebar-wrapper').removeClass('active');
            \$('.overlay').removeClass('active');
        });
        
        // User greeting based on time of day
        updateUserGreeting();
        
        function updateUserGreeting() {
            const hour = new Date().getHours();
            let greeting = \"Good \";
            
            if (hour < 12) greeting += \"Morning\";
            else if (hour < 18) greeting += \"Afternoon\";
            else greeting += \"Evening\";
            
            // Update welcome message if element exists
            const welcomeElement = \$('.fw-semibold:contains(\"Welcome back\")');
            if (welcomeElement.length) {
                welcomeElement.text(greeting + ',');
            }
        }
        
        // Delete order items from cart
        \$('.order-delete').on('click', function(e) {
            e.preventDefault();
            \$(this).closest('.order-item').fadeOut(300, function() {
                \$(this).remove();
                // Update order count
                const orderCount = \$('.order-item').length;
                \$('#offcanvasRightLabel').text(orderCount + ' New Orders');
                \$('.badge-notify').text(orderCount);
            });
        });
        
        // Initialize metismenu sidebar
        \$('#sidenav').metisMenu();
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Search functionality
        \$('.search-control, .mobile-search-control').on('input', function() {
            const searchTerm = \$(this).val().toLowerCase();
            if (searchTerm.length > 0) {
                \$('.search-popup').addClass('show');
            } else {
                \$('.search-popup').removeClass('show');
            }
        });
        
        \$('.search-close, .mobile-search-close').on('click', function() {
            \$('.search-popup').removeClass('show');
            \$('.search-control, .mobile-search-control').val('');
        });
        
        // Mobile search toggle
        \$('.mobile-search-btn').on('click', function() {
            \$('.search-popup').toggleClass('show');
        });
        
        // Notification close button
        \$('.notify-close').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            \$(this).closest('a').fadeOut(300, function() {
                \$(this).remove();
                // Update notification count
                const notifyCount = \$('.notify-list > div').length;
                \$('.badge-notify').first().text(notifyCount);
            });
        });
    });
</script>
{% endblock %}

<!-- Performance Metrics Bar -->
<div class=\"performance-metrics\">
    <div class=\"metrics-left\">
        <span>75 requêtes</span>
        <span>|</span>
        <span>180 ko</span>
        <span>|</span>
        <span>12 ms</span>
    </div>
    <div class=\"metrics-right\">
        <span>Symfony Debug Toolbar</span>
    </div>
</div>

<!-- Hide Symfony debug toolbar and fix missing images -->
<style>
    /* Hide Symfony debug toolbar */
    .sf-toolbar, .sf-minitoolbar {
        display: none !important;
    }
    
    /* Hide performance metrics bar if it's from Symfony */
    body > div:last-child {
        display: none !important;
    }
</style>

<script>
    // Fix missing 08.png image
    document.addEventListener('DOMContentLoaded', function() {
        const img08 = document.querySelector('img[src*=\"08.png\"]');
        if (img08) {
            img08.onerror = function() {
                this.src = '{{ asset(\"Back_Office/assets/images/orders/01.png\") }}'; // Fallback to existing image
                this.style.backgroundColor = '#f0f0f0'; // Add background color
            };
        }
        
        // Fix all missing images with assets_back paths
        const allImages = document.querySelectorAll('img[src*=\"assets_back\"]');
        allImages.forEach(function(img) {
            img.src = img.src.replace('assets_back', 'Back_Office/assets');
        });
    });
</script>

</body>
</html>
", "dashboard/index.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\dashboard\\index.html.twig");
    }
}
