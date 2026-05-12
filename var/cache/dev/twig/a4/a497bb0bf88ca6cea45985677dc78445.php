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

/* page/index_old_backup.html.twig */
class __TwigTemplate_00b0a3d7735e829186be3282b492712b extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "page/index_old_backup.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "page/index_old_backup.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Braine Digital Agency";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"page-wrapper\">
\t
\t<!-- Cursor -->
\t<div class=\"cursor\"></div>
\t<div class=\"cursor-follower\"></div>
\t<!-- Cursor End -->
 \t
\t<!-- Preloader -->
\t<div class=\"loader-wrap\">
\t\t<div class=\"preloader\">
\t\t\t<div class=\"preloader-close\">x</div>
\t\t\t<div id=\"handle-preloader\" class=\"handle-preloader\">
\t\t\t\t<div class=\"animation-preloader\">
\t\t\t\t\t<div class=\"txt-loading\">
\t\t\t\t\t\t<span data-text-preloader=\"L\" class=\"letters-loading\">L</span>
\t\t\t\t\t\t<span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
\t\t\t\t\t\t<span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
\t\t\t\t\t\t<span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
\t\t\t\t\t\t<span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
\t\t\t\t\t\t<span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
\t\t\t\t\t\t<span data-text-preloader=\"G\" class=\"letters-loading\">G</span>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<!-- Preloader End -->
\t
\t<!-- Main Header -->
\t<header class=\"main-header header-style-one\">
\t\t
\t\t<!-- Header Lower -->
\t\t<div class=\"header-lower\">
\t\t\t<div class=\"auto-container\">
\t\t\t\t<div class=\"inner-container\">
\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"logo-box\">
\t\t\t\t\t\t\t<div class=\"logo\"><a href=\"";
        // line 44
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\"><img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/logo.svg"), "html", null, true);
        yield "\" alt=\"\" title=\"\"></a></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"nav-outer d-flex flex-wrap\">
\t\t\t\t\t\t\t<!-- Main Menu -->
\t\t\t\t\t\t\t<nav class=\"main-menu navbar-expand-md\">
\t\t\t\t\t\t\t\t<div class=\"navbar-header\">
\t\t\t\t\t\t\t\t\t<!-- Toggle Button -->    \t
\t\t\t\t\t\t\t\t\t<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
\t\t\t\t\t\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"navbar-collapse collapse clearfix\" id=\"navbarSupportedContent\">
\t\t\t\t\t\t\t\t\t<ul class=\"navigation clearfix\">
\t\t\t\t\t\t\t\t\t\t<!--<li class=\"dropdown\">-->
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 62
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
\t\t\t\t\t\t\t\t\t\t<!--</li>-->
\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">About</a></li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">options</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Faq</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Price</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Testimonial</a></li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">Services</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feed</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Contact</a></li>
\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</nav>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Main Menu End-->
\t\t\t\t\t\t<div class=\"outer-box d-flex align-items-center flex-wrap\">

\t\t\t\t\t\t\t<!-- Language DropDown -->
\t\t\t\t\t\t\t<div class=\"language-dropdown\">
\t\t\t\t\t\t\t\t<button class=\"btn dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<span class=\"flag\"><img src=\"";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/flag.png"), "html", null, true);
        yield "\" alt=\"\" /></span> <span class=\"fa-solid fa-angle-down fa-fw\"></span>
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"";
        // line 95
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/flag.png"), "html", null, true);
        yield "\" alt=\"\" /></span> English</a></li>
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"";
        // line 96
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/arabic.png"), "html", null, true);
        yield "\" alt=\"\" /></span> Arbic</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<!-- Button Box -->
\t\t\t\t\t\t\t<div class=\"main-header_buttons\">
\t\t\t\t\t\t\t\t";
        // line 102
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 102, $this->source); })()), "user", [], "any", false, false, false, 102)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 103
            yield "\t\t\t\t\t\t\t\t\t";
            // line 104
            yield "\t\t\t\t\t\t\t\t\t";
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 105
                yield "\t\t\t\t\t\t\t\t\t\t";
                // line 106
                yield "\t\t\t\t\t\t\t\t\t\t<a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_index");
                yield "\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t";
            } else {
                // line 113
                yield "\t\t\t\t\t\t\t\t\t\t";
                // line 114
                yield "\t\t\t\t\t\t\t\t\t\t<span class=\"welcome-text\">Welcome, ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 114), "name", [], "any", true, true, false, 114)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 114, $this->source); })()), "user", [], "any", false, false, false, 114), "name", [], "any", false, false, false, 114), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 114, $this->source); })()), "user", [], "any", false, false, false, 114), "email", [], "any", false, false, false, 114))) : (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 114, $this->source); })()), "user", [], "any", false, false, false, 114), "email", [], "any", false, false, false, 114))), "html", null, true);
                yield "</span>
\t\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 115
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
                yield "\" class=\"profile-link\" title=\"Mon Profil\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fas fa-user-circle\"></i>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t";
            }
            // line 119
            yield "\t\t\t\t\t\t\t\t\t";
            // line 120
            yield "\t\t\t\t\t\t\t\t\t<a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Logout</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Logout</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t";
        } else {
            // line 127
            yield "\t\t\t\t\t\t\t\t\t";
            // line 128
            yield "\t\t\t\t\t\t\t\t\t<a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Login</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Login</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t<a href=\"";
            // line 134
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Join now</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Join now</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t";
        }
        // line 141
        yield "\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<!-- Mobile Navigation Toggler -->
\t\t\t\t\t\t\t<div class=\"mobile-nav-toggler\">
\t\t\t\t\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-menu-2\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M4 6l16 0\" /><path d=\"M4 12l16 0\" /><path d=\"M4 18l16 0\" /></svg>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<!--End Header Lower-->
\t\t
\t\t<!-- Mobile Menu  -->
\t\t<div class=\"mobile-menu\">
\t\t\t<div class=\"menu-backdrop\"></div>
\t\t\t<div class=\"close-btn\"><span class=\"icon fa-solid fa-xmark fa-fw\"></span></div>
\t\t\t
\t\t\t<nav class=\"menu-box\">
\t\t\t\t<div class=\"nav-logo\"><a href=\"";
        // line 162
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\"><img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/mobile-logo.svg"), "html", null, true);
        yield "\" alt=\"\" title=\"\"></a></div>
\t\t\t\t<div class=\"menu-outer\"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
\t\t\t</nav>
\t\t</div>
\t\t<!-- End Mobile Menu -->
\t
\t</header>
\t<!-- End Main Header -->
\t
\t<!-- Slider One -->
\t<section class=\"slider-one\">
\t\t<div class=\"main-slider swiper-container\">
\t\t\t<div class=\"swiper-wrapper\">

\t\t\t\t<!-- Slide -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url(";
        // line 178
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url(";
        // line 179
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url(";
        // line 180
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url(";
        // line 181
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-2.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url(";
        // line 182
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-4.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"";
        // line 188
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/hand.png"), "html", null, true);
        yield "\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Present your ideas in captivating live pitch sessions.</span> </h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Shine in real time.</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 192
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_video\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"https://www.youtube.com/watch?v=kxPCFljwJws\" class=\"lightbox-video play-box\"><span class=\"fa fa-play\"></span></a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_image-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_pattern-three\" style=\"background-image:url(";
        // line 206
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-3.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<!-- Slider One Author -->
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"";
        // line 210
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-2.png"), "html", null, true);
        yield "\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Aarfaoui Yassine</h5>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author-text\">Social media manager</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- Slider One Percent -->
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-up fa-fw\"></i>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percent\">90<sub>%</sub></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage-text\">efficiency</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph\">
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph-title\">Annual goal <span>\$98,541 <sup><i class=\"fa-solid fa-caret-up fa-fw\"></i>110%</sup></span></div>
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 222
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/graph.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 225
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/image-1.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Slide 2 -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url(";
        // line 236
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url(";
        // line 237
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url(";
        // line 238
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url(";
        // line 239
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-2.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url(";
        // line 240
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-4.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"";
        // line 246
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/hand.png"), "html", null, true);
        yield "\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Join a community of entrepreneurs, investors, and students.</h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Connect and innovate together</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 250
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_video\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"https://www.youtube.com/watch?v=kxPCFljwJws\" class=\"lightbox-video play-box\"><span class=\"fa fa-play\"></span></a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_image-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_pattern-three\" style=\"background-image:url(";
        // line 264
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-3.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"";
        // line 267
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-2.png"), "html", null, true);
        yield "\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Aamara Chiheb</h5>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author-text\">Video Editor</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-up fa-fw\"></i>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percent\">90<sub>%</sub></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage-text\">efficiency</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph\">
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph-title\">Annual goal <span>\$98,541 <sup><i class=\"fa-solid fa-caret-up fa-fw\"></i>110%</sup></span></div>
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 278
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/graph.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 281
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/mirror.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Slide 3 -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url(";
        // line 291
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url(";
        // line 292
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url(";
        // line 293
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url(";
        // line 294
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-2.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url(";
        // line 295
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-4.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"";
        // line 301
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/hand.png"), "html", null, true);
        yield "\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Take online courses and test your skills with interactive quizzes.</h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Learn at your own pace.</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 305
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_video\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"https://www.youtube.com/watch?v=kxPCFljwJws\" class=\"lightbox-video play-box\"><span class=\"fa fa-play\"></span></a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_image-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_pattern-three\" style=\"background-image:url(";
        // line 319
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-3.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"";
        // line 322
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-2.png"), "html", null, true);
        yield "\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Laradh Youssef</h5>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author-text\">Social media manager</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-up fa-fw\"></i>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percent\">90<sub>%</sub></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage-text\">efficiency</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph\">
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph-title\">Annual goal <span>\$98,541 <sup><i class=\"fa-solid fa-caret-up fa-fw\"></i>110%</sup></span></div>
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 333
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/graph.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 336
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/image-3.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Main Slider Section -->

\t<!-- Services One -->
\t<section class=\"services-one\">
\t\t<div class=\"auto-container\">
\t\t\t<!-- Sec Title -->
\t\t\t<div class=\"sec-title centered\">
\t\t\t\t<div class=\"sec-title_title\">Our Service</div>
\t\t\t\t<h2 class=\"sec-title_heading\">Experience our latest <br> <span>new features</span></h2>
\t\t\t</div>
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInLeft\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-speaker1\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Events</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Discover exciting events tailored to connect, inspire, and empower individuals from all walks of life.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">01</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInUp\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-marketing\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Feeds</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Stay updated with real-time feeds showcasing the latest news, insights, and community highlights.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">02</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInRight\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-users\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Quiz</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Test your knowledge and track your progress with interactive quizzes designed to reinforce learning and boost retention.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">03</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInLeft\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-copyright\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Courses</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Explore a variety of expert-led courses designed to help you learn, grow, and achieve your goals at your own pace.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">04</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block Two -->
\t\t\t\t<div class=\"service-block_two col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_two-inner wow fadeInRight\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_two-sideicon\" style=\"background-image:url(";
        // line 422
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/service-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t<div class=\"service-block_two-icon\">
\t\t\t\t\t\t\t<img src=\"";
        // line 424
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/service.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_two-heading\"><a href=\"#\">More service</a></h5>
\t\t\t\t\t\t<div class=\"service-block_two-text\"></div>
\t\t\t\t\t\t<div class=\"service-block_two-button\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">learn more</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">learn more</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Services One -->
\t
\t<!-- About One -->
\t<section class=\"about-one\">
\t\t<div class=\"about-one_pattern\" style=\"background-image:url(";
        // line 446
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/about-pattern.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"about-one_icon\" style=\"background-image:url(";
        // line 447
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/about-1.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"about-one_icon-two\" style=\"background-image:url(";
        // line 448
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/about-2.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"about-one_tab-column col-xl-6 col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"about-one_tab-outer\">
\t\t\t\t\t\t<div class=\"about-one_tab-shadow\" style=\"background-image:url(";
        // line 455
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/tab-shadow.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t<div class=\"about-one_tab-image\">
\t\t\t\t\t\t\t<img src=\"";
        // line 457
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/tabs.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Content Column -->
\t\t\t\t<div class=\"about-one_content-column col-xl-6 col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"about-one_content-outer\">
\t\t\t\t\t\t<!-- Sec Title -->
\t\t\t\t\t\t<div class=\"sec-title\">
\t\t\t\t\t\t\t<div class=\"sec-title_title\">About us</div>
\t\t\t\t\t\t\t<h2 class=\"sec-title_heading\"><span>what you need to Know</span></h2>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<p>At our platform, <span>entrepreneurs, investors, and students</span> are empowered by combining expert-led courses, live pitch events, and a collaborative community to fuel innovation and drive success.</p>
\t\t\t\t\t\t<div class=\"about-one_options d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Know more</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Know more</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<div class=\"about-one_rating-box d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t4.7
\t\t\t\t\t\t\t\t<div class=\"about-one_rating\">
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<i>Customer rating</i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End About One -->
\t
\t<!-- Choose One -->
\t<section class=\"choose-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title light centered\">
\t\t\t\t\t<div class=\"sec-title_title\">why choose us</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">Reason to choose our <br> <span>platform</span></h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"row clearfix\">

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-instagram fa-fw\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"8000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">More than 8,000 customers have experimented with our platform</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"150ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-facebook-f\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"500000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">Large community of entrepreneurs and investors</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"300ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-instagram fa-fw\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"200000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">Active student community learning and growing</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Choose One -->

\t<!-- Answer One -->
\t<section class=\"answer-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"answer-one_title-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"answer-one_title-outer\">
\t\t\t\t\t\t<!-- Sec Title -->
\t\t\t\t\t\t<div class=\"sec-title title-anim\">
\t\t\t\t\t\t\t<div class=\"sec-title_title\">Why Choose Us?</div>
\t\t\t\t\t\t\t<h2 class=\"sec-title_heading\">Unlock Your <span>Potential</span> With Us</h2>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<ul class=\"answer-one_list\">
\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Real Opportunities</li>
\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Skill Building</li>
\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Dynamic Community</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t<div class=\"answer-one_button\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Know more</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Know more</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"answer-one_content-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"answer-one_content-outer\">
\t\t\t\t\t\t<div class=\"answer-one_pattern\" style=\"background-image:url(";
        // line 574
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/faq-shadow.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t<div class=\"answer-one_image\">
\t\t\t\t\t\t\t<img src=\"";
        // line 576
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/faq.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t</div>\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Answer One -->

\t<!-- Testimonial One -->
\t<section class=\"testimonial-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\" style=\"background-image:url(";
        // line 589
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/testimonial-one_bg.png"), "html", null, true);
        yield ")\">
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title centered\">
\t\t\t\t\t<div class=\"sec-title_title\">Testimonials</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">What our respectable <br> <span>clients says</span></h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"three-item_carousel swiper-container\">
\t\t\t\t\t<div class=\"swiper-wrapper\">
\t\t
\t\t\t\t\t\t<!-- Slide -->
\t\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t\t<!-- Testimonial Block One -->
\t\t\t\t\t\t\t<div class=\"testimonial-block_one\">
\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-rating\">
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-text\">Lorem ipsum amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit <span>Pellentesque sit amet</span> sapien fringilla, mattis ligula consectetur, ultrices mauris.</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author_box\">
\t\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author-image\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 613
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/author-2.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\tLarry K. Lund <span>Social Media Manager</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Slide -->
\t\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t\t<!-- Testimonial Block One -->
\t\t\t\t\t\t\t<div class=\"testimonial-block_one\">
\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-rating\">
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-text\">Lorem ipsum amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit <span>Pellentesque sit amet</span> sapien fringilla, mattis ligula consectetur, ultrices mauris.</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author_box\">
\t\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author-image\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 636
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/author-3.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\tMarian R. Vieira <span>Social Media Manager</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Slide -->
\t\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t\t<!-- Testimonial Block One -->
\t\t\t\t\t\t\t<div class=\"testimonial-block_one\">
\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-rating\">
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-text\">Lorem ipsum amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit <span>Pellentesque sit amet</span> sapien fringilla, mattis ligula consectetur, ultrices mauris.</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author_box\">
\t\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author-image\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 659
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/author-4.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\tBob E. Wiggins <span>Social Media Manager</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>

\t\t\t\t\t<!-- If we need pagination -->
\t\t\t\t\t<div class=\"three-item_carousel-pagination\"></div>

\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Testimonial One -->

\t<!-- Steps One -->
\t<section class=\"steps-one\">
\t\t<div class=\"steps-one_bg\" style=\"background-image:url(";
        // line 681
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/step-1_bg.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"steps-one_icon\" style=\"background-image:url(";
        // line 682
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/step.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<div class=\"circle-layer\"></div>
\t\t\t\t<div class=\"dots-layer\">
\t\t\t\t\t<span class=\"dot-one\"></span>
\t\t\t\t\t<span class=\"dot-two\"></span>
\t\t\t\t</div>
\t\t\t
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title\">
\t\t\t\t\t<div class=\"sec-title_title\">How its work</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">Braine <span>typically operate</span> in <br> a three steps</h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"steps-one_button\">
\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t<span class=\"text-one\">Know more</span>
\t\t\t\t\t\t\t<span class=\"text-two\">Know more</span>
\t\t\t\t\t\t</span>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t<!-- Column -->
\t\t\t\t\t<div class=\"column col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t\t<!-- Step Block One -->
\t\t\t\t\t\t<div class=\"step-block_one\">
\t\t\t\t\t\t\t<div class=\"step-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"step-block_one-steps\">step 01</div>
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Join the Community</h5>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-text\">Sign up as an entrepreneur, investor, or student and create your profile.</div>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-content\">
\t\t\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 715
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/step-1.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- Column -->
\t\t\t\t\t<div class=\"column col-lg-6 col-md-12 col-sm-12\">

\t\t\t\t\t\t<!-- Step Block One -->
\t\t\t\t\t\t<div class=\"step-block_one\">
\t\t\t\t\t\t\t<div class=\"step-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"step-block_one-steps\">step 02</div>
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Learn & Prepare</h5>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-text\">Explore e-learning courses, take quizzes, and get ready to pitch or invest.</div>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-content\">
\t\t\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 732
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/step-2.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Step Block One -->
\t\t\t\t\t\t<div class=\"step-block_one\">
\t\t\t\t\t\t\t<div class=\"step-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"step-block_one-steps\">step 03</div>
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Connect & Pitch</h5>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-text\">Participate in live pitch sessions, events, and start collaborating on real projects.</div>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-content\">
\t\t\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 746
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/step-3.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Steps One -->

\t<!-- Price One -->
\t<section class=\"price-one\">
\t\t<div class=\"price-one_bg\" style=\"background-image:url(";
        // line 761
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/price-bg.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title title-anim centered\">
\t\t\t\t\t<div class=\"sec-title_title\">Our Pricing</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">Join for <span>free</span> Today</h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"pricing-tabs tabs-box\">
\t\t\t\t\t
\t\t\t\t\t<!--Tab Btns-->
\t\t\t\t\t<div class=\"buttons-outer\">
\t\t\t\t\t\t<ul class=\"tab-buttons clearfix\">
\t\t\t\t\t\t\t<li data-tab=\"#prod-monthly\" class=\"tab-btn active-btn\">Monthly</li>
\t\t\t\t\t\t\t<li data-tab=\"#prod-yearly\" class=\"tab-btn\">Yearly</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>

\t\t\t\t\t<!--Tabs Container-->
\t\t\t\t\t<div class=\"tabs-content\">
\t\t\t\t\t\t
\t\t\t\t\t\t<!-- Tab -->
\t\t\t\t\t\t<div class=\"tab active-tab\" id=\"prod-monthly\">
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">

\t\t\t\t\t\t\t\t\t<!-- Price Block One -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Starter</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Perfect for students and early-stage entrepreneurs</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>3<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"";
        // line 798
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic courses</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>View pitch events</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Join community discussions</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one active col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-one_stars\" style=\"background-image:url(";
        // line 814
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/price-stars.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Professional</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Ideal for active learners and aspiring entrepreneurs</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>9<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"";
        // line 823
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Full access to all courses & quizzes</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Attend live pitch sessions</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Priority support</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Direct messaging</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advanced analytics</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Investor</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Designed for investors and mentors</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>18<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"";
        // line 847
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Full access to all courses & quizzes</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Direct communication with entrepreneurs</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to advanced analytics</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Exclusive premium events</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Mentorship opportunities</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Price One -->

\t<!-- FAQ One -->
\t<section class=\"faq-one\">
\t\t<div class=\"faq-one_bg\" style=\"background-image:url(";
        // line 874
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/faq-bg.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"faq-one_title-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"faq-one_title-outer\">
\t\t\t\t\t\t<!-- Sec Title -->
\t\t\t\t\t\t<div class=\"sec-title title-anim\">
\t\t\t\t\t\t\t<div class=\"sec-title_title\">faq</div>
\t\t\t\t\t\t\t<h2 class=\"sec-title_heading\">Frequently asked <span>questions</span></h2>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"faq-one_button\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Contact now</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Contact now</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Accordian Column -->
\t\t\t\t<div class=\"faq-one_accordian-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"faq-one_accordian-outer\">

\t\t\t\t\t\t<!-- Accordion Box -->
\t\t\t\t\t\t<ul class=\"accordion-box_two\">
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>What is the purpose of this platform?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Our platform connects entrepreneurs, investors, and students in one dynamic space where they can pitch ideas, learn new skills, and collaborate on innovative projects.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>How can I participate in a pitch session?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Simply create an entrepreneur account, complete your profile, and register for upcoming pitch events.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Are the courses free?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">We offer a mix of free and premium courses. You can start with basic content under the Starter Plan.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Can investors contact entrepreneurs directly?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Yes, investors with an active subscription can view profiles and pitch decks.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t</ul>

\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End FAQ One -->

\t<!-- Footer -->
\t<footer class=\"main-footer\">
\t\t<div class=\"footer_pattern\" style=\"background-image: url(";
        // line 956
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/footer-pattern.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Widgets Section -->
\t\t\t\t<div class=\"widgets-section\">
\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t
\t\t\t\t\t\t<!-- Big Column -->
\t\t\t\t\t\t<div class=\"big-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-newsletter\">
\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Newsletter</h5>
\t\t\t\t\t\t\t\t<div class=\"footer-newsletter_text\">Subscribe to our newsletter for updates and news.</div>
\t\t\t\t\t\t\t\t<div class=\"newsletter-box\">
\t\t\t\t\t\t\t\t\t<form method=\"post\" action=\"#\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"icon fa-regular fa-envelope fa-fw\"></span>
\t\t\t\t\t\t\t\t\t\t\t<input type=\"email\" name=\"search-field\" value=\"\" placeholder=\"Enter your mail\" required>
\t\t\t\t\t\t\t\t\t\t\t<button type=\"submit\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Subscribe</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Subscribe</span>
\t\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Big Column -->
\t\t\t\t\t\t<div class=\"big-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-lists_outer\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t\t\t<!-- Column -->
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-5 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Services</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feeds</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Report</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- Column -->
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-3 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Resources</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Blog</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">FAQs</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Help center</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Case studies</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- Column -->
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-4 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">About us</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Our story</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Team</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Careers</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Testimonials</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"footer-bottom\">
\t\t\t<div class=\"auto-container\">
\t\t\t\t<div class=\"inner-container d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t<div class=\"footer-logo\"><a href=\"";
        // line 1031
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\"><img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/logo.svg"), "html", null, true);
        yield "\" alt=\"\" title=\"\"></a></div>
\t\t\t\t\t<div class=\"footer-copyright\">&copy; 2024 <a href=\"";
        // line 1032
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Braine.</a> All rights reserved.</div>
\t\t\t\t\t<!-- Social Box -->
\t\t\t\t\t<div class=\"footer-social_box\">
\t\t\t\t\t\t<a href=\"https://facebook.com/\"><i class=\"fa-brands fa-facebook-f\"></i></a>
\t\t\t\t\t\t<a href=\"https://twitter.com/\"><i class=\"fa-brands fa-twitter\"></i></a>
\t\t\t\t\t\t<a href=\"https://instagram.com/\"><i class=\"fa-brands fa-instagram\"></i></a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</footer>
\t<!-- End Footer -->

</div>
<!-- End PageWrapper -->

<!-- JavaScript Files -->
<script src=\"";
        // line 1049
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1050
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/bootstrap.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1051
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/appear.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1052
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/wow.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1053
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/swiper.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1054
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/odometer.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1055
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/magnific-popup.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1056
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/script.js"), "html", null, true);
        yield "\"></script>

<style>
    .welcome-text:hover {
        background: #667eea;
        color: white;
    }
    
    .profile-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
        padding: 8px 15px;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.1);
        color: #667eea;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .profile-link:hover {
        background: #5567d8;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .welcome-text {
            font-size: 14px;
            padding: 8px 15px;
        }
        
        .profile-link {
            margin-left: 10px;
            padding: 6px 12px;
        }
    }
</style>

<script>
    // Simple preloader removal
    \$(document).ready(function() {
        setTimeout(function() {
            \$('.loader-wrap').fadeOut(500);
        }, 1000);
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
        return "page/index_old_backup.html.twig";
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
        return array (  1409 => 1056,  1405 => 1055,  1401 => 1054,  1397 => 1053,  1393 => 1052,  1389 => 1051,  1385 => 1050,  1381 => 1049,  1361 => 1032,  1355 => 1031,  1277 => 956,  1192 => 874,  1162 => 847,  1135 => 823,  1123 => 814,  1104 => 798,  1064 => 761,  1046 => 746,  1029 => 732,  1009 => 715,  973 => 682,  969 => 681,  944 => 659,  918 => 636,  892 => 613,  865 => 589,  849 => 576,  844 => 574,  724 => 457,  719 => 455,  709 => 448,  705 => 447,  701 => 446,  676 => 424,  671 => 422,  582 => 336,  576 => 333,  562 => 322,  556 => 319,  539 => 305,  532 => 301,  523 => 295,  519 => 294,  515 => 293,  511 => 292,  507 => 291,  494 => 281,  488 => 278,  474 => 267,  468 => 264,  451 => 250,  444 => 246,  435 => 240,  431 => 239,  427 => 238,  423 => 237,  419 => 236,  405 => 225,  399 => 222,  384 => 210,  377 => 206,  360 => 192,  353 => 188,  344 => 182,  340 => 181,  336 => 180,  332 => 179,  328 => 178,  307 => 162,  284 => 141,  274 => 134,  264 => 128,  262 => 127,  251 => 120,  249 => 119,  242 => 115,  237 => 114,  235 => 113,  224 => 106,  222 => 105,  219 => 104,  217 => 103,  215 => 102,  206 => 96,  202 => 95,  196 => 92,  163 => 62,  140 => 44,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Braine Digital Agency{% endblock %}

{% block body %}
<div class=\"page-wrapper\">
\t
\t<!-- Cursor -->
\t<div class=\"cursor\"></div>
\t<div class=\"cursor-follower\"></div>
\t<!-- Cursor End -->
 \t
\t<!-- Preloader -->
\t<div class=\"loader-wrap\">
\t\t<div class=\"preloader\">
\t\t\t<div class=\"preloader-close\">x</div>
\t\t\t<div id=\"handle-preloader\" class=\"handle-preloader\">
\t\t\t\t<div class=\"animation-preloader\">
\t\t\t\t\t<div class=\"txt-loading\">
\t\t\t\t\t\t<span data-text-preloader=\"L\" class=\"letters-loading\">L</span>
\t\t\t\t\t\t<span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
\t\t\t\t\t\t<span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
\t\t\t\t\t\t<span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
\t\t\t\t\t\t<span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
\t\t\t\t\t\t<span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
\t\t\t\t\t\t<span data-text-preloader=\"G\" class=\"letters-loading\">G</span>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<!-- Preloader End -->
\t
\t<!-- Main Header -->
\t<header class=\"main-header header-style-one\">
\t\t
\t\t<!-- Header Lower -->
\t\t<div class=\"header-lower\">
\t\t\t<div class=\"auto-container\">
\t\t\t\t<div class=\"inner-container\">
\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"logo-box\">
\t\t\t\t\t\t\t<div class=\"logo\"><a href=\"{{ path('app_homepage') }}\"><img src=\"{{ asset('assets_front/images/logo.svg') }}\" alt=\"\" title=\"\"></a></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"nav-outer d-flex flex-wrap\">
\t\t\t\t\t\t\t<!-- Main Menu -->
\t\t\t\t\t\t\t<nav class=\"main-menu navbar-expand-md\">
\t\t\t\t\t\t\t\t<div class=\"navbar-header\">
\t\t\t\t\t\t\t\t\t<!-- Toggle Button -->    \t
\t\t\t\t\t\t\t\t\t<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
\t\t\t\t\t\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"icon-bar\"></span>
\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"navbar-collapse collapse clearfix\" id=\"navbarSupportedContent\">
\t\t\t\t\t\t\t\t\t<ul class=\"navigation clearfix\">
\t\t\t\t\t\t\t\t\t\t<!--<li class=\"dropdown\">-->
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"{{ path('app_homepage') }}\">Home</a></li>
\t\t\t\t\t\t\t\t\t\t<!--</li>-->
\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">About</a></li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">options</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Faq</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Price</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Testimonial</a></li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">Services</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feed</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Contact</a></li>
\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</nav>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Main Menu End-->
\t\t\t\t\t\t<div class=\"outer-box d-flex align-items-center flex-wrap\">

\t\t\t\t\t\t\t<!-- Language DropDown -->
\t\t\t\t\t\t\t<div class=\"language-dropdown\">
\t\t\t\t\t\t\t\t<button class=\"btn dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
\t\t\t\t\t\t\t\t\t<span class=\"flag\"><img src=\"{{ asset('assets_front/images/icons/flag.png') }}\" alt=\"\" /></span> <span class=\"fa-solid fa-angle-down fa-fw\"></span>
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"{{ asset('assets_front/images/icons/flag.png') }}\" alt=\"\" /></span> English</a></li>
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"{{ asset('assets_front/images/icons/arabic.png') }}\" alt=\"\" /></span> Arbic</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<!-- Button Box -->
\t\t\t\t\t\t\t<div class=\"main-header_buttons\">
\t\t\t\t\t\t\t\t{% if app.user %}
\t\t\t\t\t\t\t\t\t{# User is logged in #}
\t\t\t\t\t\t\t\t\t{% if is_granted('ROLE_ADMIN') %}
\t\t\t\t\t\t\t\t\t\t{# Admin user - show Dashboard button #}
\t\t\t\t\t\t\t\t\t\t<a href=\"{{ path('dashboard_index') }}\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t\t{# Regular user/student - show welcome message, profile link, and logout #}
\t\t\t\t\t\t\t\t\t\t<span class=\"welcome-text\">Welcome, {{ app.user.name|default(app.user.email) }}</span>
\t\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_profile') }}\" class=\"profile-link\" title=\"Mon Profil\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fas fa-user-circle\"></i>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t\t\t{# Show logout button for all logged-in users #}
\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_logout') }}\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Logout</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Logout</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t{# Not logged in - show login/register buttons #}
\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_login') }}\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Login</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Login</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_register') }}\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Join now</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Join now</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<!-- Mobile Navigation Toggler -->
\t\t\t\t\t\t\t<div class=\"mobile-nav-toggler\">
\t\t\t\t\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-menu-2\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M4 6l16 0\" /><path d=\"M4 12l16 0\" /><path d=\"M4 18l16 0\" /></svg>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<!--End Header Lower-->
\t\t
\t\t<!-- Mobile Menu  -->
\t\t<div class=\"mobile-menu\">
\t\t\t<div class=\"menu-backdrop\"></div>
\t\t\t<div class=\"close-btn\"><span class=\"icon fa-solid fa-xmark fa-fw\"></span></div>
\t\t\t
\t\t\t<nav class=\"menu-box\">
\t\t\t\t<div class=\"nav-logo\"><a href=\"{{ path('app_homepage') }}\"><img src=\"{{ asset('assets_front/images/mobile-logo.svg') }}\" alt=\"\" title=\"\"></a></div>
\t\t\t\t<div class=\"menu-outer\"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
\t\t\t</nav>
\t\t</div>
\t\t<!-- End Mobile Menu -->
\t
\t</header>
\t<!-- End Main Header -->
\t
\t<!-- Slider One -->
\t<section class=\"slider-one\">
\t\t<div class=\"main-slider swiper-container\">
\t\t\t<div class=\"swiper-wrapper\">

\t\t\t\t<!-- Slide -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url({{ asset('assets_front/images/main-slider/icon-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url({{ asset('assets_front/images/main-slider/icon-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-2.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-4.png') }})\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"{{ asset('assets_front/images/main-slider/hand.png') }}\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Present your ideas in captivating live pitch sessions.</span> </h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Shine in real time.</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_register') }}\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_video\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"https://www.youtube.com/watch?v=kxPCFljwJws\" class=\"lightbox-video play-box\"><span class=\"fa fa-play\"></span></a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_image-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_pattern-three\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-3.png') }})\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<!-- Slider One Author -->
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"{{ asset('assets_front/images/main-slider/icon-2.png') }}\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Aarfaoui Yassine</h5>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author-text\">Social media manager</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- Slider One Percent -->
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-up fa-fw\"></i>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percent\">90<sub>%</sub></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage-text\">efficiency</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph\">
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph-title\">Annual goal <span>\$98,541 <sup><i class=\"fa-solid fa-caret-up fa-fw\"></i>110%</sup></span></div>
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/main-slider/graph.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/main-slider/image-1.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Slide 2 -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url({{ asset('assets_front/images/main-slider/icon-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url({{ asset('assets_front/images/main-slider/icon-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-2.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-4.png') }})\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"{{ asset('assets_front/images/main-slider/hand.png') }}\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Join a community of entrepreneurs, investors, and students.</h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Connect and innovate together</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_register') }}\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_video\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"https://www.youtube.com/watch?v=kxPCFljwJws\" class=\"lightbox-video play-box\"><span class=\"fa fa-play\"></span></a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_image-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_pattern-three\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-3.png') }})\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"{{ asset('assets_front/images/main-slider/icon-2.png') }}\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Aamara Chiheb</h5>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author-text\">Video Editor</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-up fa-fw\"></i>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percent\">90<sub>%</sub></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage-text\">efficiency</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph\">
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph-title\">Annual goal <span>\$98,541 <sup><i class=\"fa-solid fa-caret-up fa-fw\"></i>110%</sup></span></div>
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/main-slider/graph.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/main-slider/mirror.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Slide 3 -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url({{ asset('assets_front/images/main-slider/icon-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url({{ asset('assets_front/images/main-slider/icon-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-1.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-2.png') }})\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-4.png') }})\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"{{ asset('assets_front/images/main-slider/hand.png') }}\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Take online courses and test your skills with interactive quizzes.</h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Learn at your own pace.</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_register') }}\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_video\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"https://www.youtube.com/watch?v=kxPCFljwJws\" class=\"lightbox-video play-box\"><span class=\"fa fa-play\"></span></a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_image-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_pattern-three\" style=\"background-image:url({{ asset('assets_front/images/main-slider/pattern-3.png') }})\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"{{ asset('assets_front/images/main-slider/icon-2.png') }}\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Laradh Youssef</h5>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author-text\">Social media manager</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-up fa-fw\"></i>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percent\">90<sub>%</sub></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_percentage-text\">efficiency</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph\">
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_graph-title\">Annual goal <span>\$98,541 <sup><i class=\"fa-solid fa-caret-up fa-fw\"></i>110%</sup></span></div>
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/main-slider/graph.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/main-slider/image-3.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Main Slider Section -->

\t<!-- Services One -->
\t<section class=\"services-one\">
\t\t<div class=\"auto-container\">
\t\t\t<!-- Sec Title -->
\t\t\t<div class=\"sec-title centered\">
\t\t\t\t<div class=\"sec-title_title\">Our Service</div>
\t\t\t\t<h2 class=\"sec-title_heading\">Experience our latest <br> <span>new features</span></h2>
\t\t\t</div>
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInLeft\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-speaker1\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Events</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Discover exciting events tailored to connect, inspire, and empower individuals from all walks of life.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">01</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInUp\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-marketing\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Feeds</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Stay updated with real-time feeds showcasing the latest news, insights, and community highlights.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">02</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInRight\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-users\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Quiz</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Test your knowledge and track your progress with interactive quizzes designed to reinforce learning and boost retention.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">03</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInLeft\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-copyright\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Courses</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Explore a variety of expert-led courses designed to help you learn, grow, and achieve your goals at your own pace.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">04</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block Two -->
\t\t\t\t<div class=\"service-block_two col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_two-inner wow fadeInRight\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_two-sideicon\" style=\"background-image:url({{ asset('assets_front/images/icons/service-1.png') }})\"></div>
\t\t\t\t\t\t<div class=\"service-block_two-icon\">
\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/icons/service.png') }}\" alt=\"\" />
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_two-heading\"><a href=\"#\">More service</a></h5>
\t\t\t\t\t\t<div class=\"service-block_two-text\"></div>
\t\t\t\t\t\t<div class=\"service-block_two-button\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">learn more</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">learn more</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Services One -->
\t
\t<!-- About One -->
\t<section class=\"about-one\">
\t\t<div class=\"about-one_pattern\" style=\"background-image:url({{ asset('assets_front/images/background/about-pattern.png') }})\"></div>
\t\t<div class=\"about-one_icon\" style=\"background-image:url({{ asset('assets_front/images/icons/about-1.png') }})\"></div>
\t\t<div class=\"about-one_icon-two\" style=\"background-image:url({{ asset('assets_front/images/icons/about-2.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"about-one_tab-column col-xl-6 col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"about-one_tab-outer\">
\t\t\t\t\t\t<div class=\"about-one_tab-shadow\" style=\"background-image:url({{ asset('assets_front/images/background/tab-shadow.png') }})\"></div>
\t\t\t\t\t\t<div class=\"about-one_tab-image\">
\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/tabs.png') }}\" alt=\"\" />
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Content Column -->
\t\t\t\t<div class=\"about-one_content-column col-xl-6 col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"about-one_content-outer\">
\t\t\t\t\t\t<!-- Sec Title -->
\t\t\t\t\t\t<div class=\"sec-title\">
\t\t\t\t\t\t\t<div class=\"sec-title_title\">About us</div>
\t\t\t\t\t\t\t<h2 class=\"sec-title_heading\"><span>what you need to Know</span></h2>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<p>At our platform, <span>entrepreneurs, investors, and students</span> are empowered by combining expert-led courses, live pitch events, and a collaborative community to fuel innovation and drive success.</p>
\t\t\t\t\t\t<div class=\"about-one_options d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Know more</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Know more</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t<div class=\"about-one_rating-box d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t4.7
\t\t\t\t\t\t\t\t<div class=\"about-one_rating\">
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t<i>Customer rating</i>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End About One -->
\t
\t<!-- Choose One -->
\t<section class=\"choose-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title light centered\">
\t\t\t\t\t<div class=\"sec-title_title\">why choose us</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">Reason to choose our <br> <span>platform</span></h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"row clearfix\">

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-instagram fa-fw\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"8000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">More than 8,000 customers have experimented with our platform</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"150ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-facebook-f\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"500000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">Large community of entrepreneurs and investors</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"300ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-instagram fa-fw\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"200000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">Active student community learning and growing</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Choose One -->

\t<!-- Answer One -->
\t<section class=\"answer-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"answer-one_title-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"answer-one_title-outer\">
\t\t\t\t\t\t<!-- Sec Title -->
\t\t\t\t\t\t<div class=\"sec-title title-anim\">
\t\t\t\t\t\t\t<div class=\"sec-title_title\">Why Choose Us?</div>
\t\t\t\t\t\t\t<h2 class=\"sec-title_heading\">Unlock Your <span>Potential</span> With Us</h2>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<ul class=\"answer-one_list\">
\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Real Opportunities</li>
\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Skill Building</li>
\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Dynamic Community</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t<div class=\"answer-one_button\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Know more</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Know more</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"answer-one_content-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"answer-one_content-outer\">
\t\t\t\t\t\t<div class=\"answer-one_pattern\" style=\"background-image:url({{ asset('assets_front/images/background/faq-shadow.png') }})\"></div>
\t\t\t\t\t\t<div class=\"answer-one_image\">
\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/faq.png') }}\" alt=\"\" />
\t\t\t\t\t\t</div>\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Answer One -->

\t<!-- Testimonial One -->
\t<section class=\"testimonial-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\" style=\"background-image:url({{ asset('assets_front/images/background/testimonial-one_bg.png') }})\">
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title centered\">
\t\t\t\t\t<div class=\"sec-title_title\">Testimonials</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">What our respectable <br> <span>clients says</span></h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"three-item_carousel swiper-container\">
\t\t\t\t\t<div class=\"swiper-wrapper\">
\t\t
\t\t\t\t\t\t<!-- Slide -->
\t\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t\t<!-- Testimonial Block One -->
\t\t\t\t\t\t\t<div class=\"testimonial-block_one\">
\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-rating\">
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-text\">Lorem ipsum amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit <span>Pellentesque sit amet</span> sapien fringilla, mattis ligula consectetur, ultrices mauris.</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author_box\">
\t\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author-image\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/author-2.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\tLarry K. Lund <span>Social Media Manager</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Slide -->
\t\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t\t<!-- Testimonial Block One -->
\t\t\t\t\t\t\t<div class=\"testimonial-block_one\">
\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-rating\">
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-text\">Lorem ipsum amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit <span>Pellentesque sit amet</span> sapien fringilla, mattis ligula consectetur, ultrices mauris.</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author_box\">
\t\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author-image\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/author-3.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\tMarian R. Vieira <span>Social Media Manager</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Slide -->
\t\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t\t<!-- Testimonial Block One -->
\t\t\t\t\t\t\t<div class=\"testimonial-block_one\">
\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-rating\">
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t\t<span class=\"fa fa-star\"></span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-text\">Lorem ipsum amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit <span>Pellentesque sit amet</span> sapien fringilla, mattis ligula consectetur, ultrices mauris.</div>
\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author_box\">
\t\t\t\t\t\t\t\t\t\t<div class=\"testimonial-block_one-author-image\">
\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/author-4.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\tBob E. Wiggins <span>Social Media Manager</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>

\t\t\t\t\t<!-- If we need pagination -->
\t\t\t\t\t<div class=\"three-item_carousel-pagination\"></div>

\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Testimonial One -->

\t<!-- Steps One -->
\t<section class=\"steps-one\">
\t\t<div class=\"steps-one_bg\" style=\"background-image:url({{ asset('assets_front/images/background/step-1_bg.png') }})\"></div>
\t\t<div class=\"steps-one_icon\" style=\"background-image:url({{ asset('assets_front/images/icons/step.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<div class=\"circle-layer\"></div>
\t\t\t\t<div class=\"dots-layer\">
\t\t\t\t\t<span class=\"dot-one\"></span>
\t\t\t\t\t<span class=\"dot-two\"></span>
\t\t\t\t</div>
\t\t\t
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title\">
\t\t\t\t\t<div class=\"sec-title_title\">How its work</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">Braine <span>typically operate</span> in <br> a three steps</h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"steps-one_button\">
\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t<span class=\"text-one\">Know more</span>
\t\t\t\t\t\t\t<span class=\"text-two\">Know more</span>
\t\t\t\t\t\t</span>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t<!-- Column -->
\t\t\t\t\t<div class=\"column col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t\t<!-- Step Block One -->
\t\t\t\t\t\t<div class=\"step-block_one\">
\t\t\t\t\t\t\t<div class=\"step-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"step-block_one-steps\">step 01</div>
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Join the Community</h5>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-text\">Sign up as an entrepreneur, investor, or student and create your profile.</div>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-content\">
\t\t\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/step-1.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- Column -->
\t\t\t\t\t<div class=\"column col-lg-6 col-md-12 col-sm-12\">

\t\t\t\t\t\t<!-- Step Block One -->
\t\t\t\t\t\t<div class=\"step-block_one\">
\t\t\t\t\t\t\t<div class=\"step-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"step-block_one-steps\">step 02</div>
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Learn & Prepare</h5>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-text\">Explore e-learning courses, take quizzes, and get ready to pitch or invest.</div>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-content\">
\t\t\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/step-2.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Step Block One -->
\t\t\t\t\t\t<div class=\"step-block_one\">
\t\t\t\t\t\t\t<div class=\"step-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"step-block_one-steps\">step 03</div>
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Connect & Pitch</h5>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-text\">Participate in live pitch sessions, events, and start collaborating on real projects.</div>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-content\">
\t\t\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/step-3.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Steps One -->

\t<!-- Price One -->
\t<section class=\"price-one\">
\t\t<div class=\"price-one_bg\" style=\"background-image:url({{ asset('assets_front/images/background/price-bg.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Sec Title -->
\t\t\t\t<div class=\"sec-title title-anim centered\">
\t\t\t\t\t<div class=\"sec-title_title\">Our Pricing</div>
\t\t\t\t\t<h2 class=\"sec-title_heading\">Join for <span>free</span> Today</h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"pricing-tabs tabs-box\">
\t\t\t\t\t
\t\t\t\t\t<!--Tab Btns-->
\t\t\t\t\t<div class=\"buttons-outer\">
\t\t\t\t\t\t<ul class=\"tab-buttons clearfix\">
\t\t\t\t\t\t\t<li data-tab=\"#prod-monthly\" class=\"tab-btn active-btn\">Monthly</li>
\t\t\t\t\t\t\t<li data-tab=\"#prod-yearly\" class=\"tab-btn\">Yearly</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>

\t\t\t\t\t<!--Tabs Container-->
\t\t\t\t\t<div class=\"tabs-content\">
\t\t\t\t\t\t
\t\t\t\t\t\t<!-- Tab -->
\t\t\t\t\t\t<div class=\"tab active-tab\" id=\"prod-monthly\">
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">

\t\t\t\t\t\t\t\t\t<!-- Price Block One -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Starter</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Perfect for students and early-stage entrepreneurs</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>3<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"{{ path('app_register') }}\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic courses</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>View pitch events</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Join community discussions</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one active col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-one_stars\" style=\"background-image:url({{ asset('assets_front/images/icons/price-stars.png') }})\"></div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Professional</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Ideal for active learners and aspiring entrepreneurs</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>9<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"{{ path('app_register') }}\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Full access to all courses & quizzes</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Attend live pitch sessions</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Priority support</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Direct messaging</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advanced analytics</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Investor</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Designed for investors and mentors</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>18<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"{{ path('app_register') }}\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Full access to all courses & quizzes</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Direct communication with entrepreneurs</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to advanced analytics</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Exclusive premium events</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Mentorship opportunities</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Price One -->

\t<!-- FAQ One -->
\t<section class=\"faq-one\">
\t\t<div class=\"faq-one_bg\" style=\"background-image:url({{ asset('assets_front/images/background/faq-bg.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"faq-one_title-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"faq-one_title-outer\">
\t\t\t\t\t\t<!-- Sec Title -->
\t\t\t\t\t\t<div class=\"sec-title title-anim\">
\t\t\t\t\t\t\t<div class=\"sec-title_title\">faq</div>
\t\t\t\t\t\t\t<h2 class=\"sec-title_heading\">Frequently asked <span>questions</span></h2>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"faq-one_button\">
\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Contact now</span>
\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Contact now</span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Accordian Column -->
\t\t\t\t<div class=\"faq-one_accordian-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"faq-one_accordian-outer\">

\t\t\t\t\t\t<!-- Accordion Box -->
\t\t\t\t\t\t<ul class=\"accordion-box_two\">
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>What is the purpose of this platform?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Our platform connects entrepreneurs, investors, and students in one dynamic space where they can pitch ideas, learn new skills, and collaborate on innovative projects.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>How can I participate in a pitch session?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Simply create an entrepreneur account, complete your profile, and register for upcoming pitch events.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Are the courses free?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">We offer a mix of free and premium courses. You can start with basic content under the Starter Plan.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Can investors contact entrepreneurs directly?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Yes, investors with an active subscription can view profiles and pitch decks.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t</ul>

\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End FAQ One -->

\t<!-- Footer -->
\t<footer class=\"main-footer\">
\t\t<div class=\"footer_pattern\" style=\"background-image: url({{ asset('assets_front/images/background/footer-pattern.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Widgets Section -->
\t\t\t\t<div class=\"widgets-section\">
\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t
\t\t\t\t\t\t<!-- Big Column -->
\t\t\t\t\t\t<div class=\"big-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-newsletter\">
\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Newsletter</h5>
\t\t\t\t\t\t\t\t<div class=\"footer-newsletter_text\">Subscribe to our newsletter for updates and news.</div>
\t\t\t\t\t\t\t\t<div class=\"newsletter-box\">
\t\t\t\t\t\t\t\t\t<form method=\"post\" action=\"#\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"icon fa-regular fa-envelope fa-fw\"></span>
\t\t\t\t\t\t\t\t\t\t\t<input type=\"email\" name=\"search-field\" value=\"\" placeholder=\"Enter your mail\" required>
\t\t\t\t\t\t\t\t\t\t\t<button type=\"submit\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Subscribe</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Subscribe</span>
\t\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Big Column -->
\t\t\t\t\t\t<div class=\"big-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-lists_outer\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t\t\t<!-- Column -->
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-5 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Services</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feeds</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Report</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- Column -->
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-3 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Resources</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Blog</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">FAQs</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Help center</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Case studies</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- Column -->
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-4 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">About us</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Our story</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Team</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Careers</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Testimonials</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"footer-bottom\">
\t\t\t<div class=\"auto-container\">
\t\t\t\t<div class=\"inner-container d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t<div class=\"footer-logo\"><a href=\"{{ path('app_homepage') }}\"><img src=\"{{ asset('assets_front/images/logo.svg') }}\" alt=\"\" title=\"\"></a></div>
\t\t\t\t\t<div class=\"footer-copyright\">&copy; 2024 <a href=\"{{ path('app_homepage') }}\">Braine.</a> All rights reserved.</div>
\t\t\t\t\t<!-- Social Box -->
\t\t\t\t\t<div class=\"footer-social_box\">
\t\t\t\t\t\t<a href=\"https://facebook.com/\"><i class=\"fa-brands fa-facebook-f\"></i></a>
\t\t\t\t\t\t<a href=\"https://twitter.com/\"><i class=\"fa-brands fa-twitter\"></i></a>
\t\t\t\t\t\t<a href=\"https://instagram.com/\"><i class=\"fa-brands fa-instagram\"></i></a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</footer>
\t<!-- End Footer -->

</div>
<!-- End PageWrapper -->

<!-- JavaScript Files -->
<script src=\"{{ asset('assets_front/js/jquery.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/bootstrap.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/appear.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/wow.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/swiper.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/odometer.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/magnific-popup.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/script.js') }}\"></script>

<style>
    .welcome-text:hover {
        background: #667eea;
        color: white;
    }
    
    .profile-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
        padding: 8px 15px;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.1);
        color: #667eea;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .profile-link:hover {
        background: #5567d8;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .welcome-text {
            font-size: 14px;
            padding: 8px 15px;
        }
        
        .profile-link {
            margin-left: 10px;
            padding: 6px 12px;
        }
    }
</style>

<script>
    // Simple preloader removal
    \$(document).ready(function() {
        setTimeout(function() {
            \$('.loader-wrap').fadeOut(500);
        }, 1000);
    });
</script>

{% endblock %}
", "page/index_old_backup.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\page\\index_old_backup.html.twig");
    }
}
