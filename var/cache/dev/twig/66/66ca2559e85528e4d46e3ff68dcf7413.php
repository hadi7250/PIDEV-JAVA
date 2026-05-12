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

/* page/index.html.twig */
class __TwigTemplate_3b65b8f571ad40b68bdff0d618987629 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "page/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "page/index.html.twig"));

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

        yield "Braine Digital Agency Business HTML-5 Template | Homepage 01";
        
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
        yield "<!DOCTYPE html>
<html>
<head>
<meta charset=\"utf-8\">
<title>Braine Digital Agency Business HTML-5 Template | Homepage 01</title>
<!-- Stylesheets -->
<link href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/css/bootstrap.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
<link href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/css/style.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
<link href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/css/meanmenu.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
<link href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/css/responsive.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">

<link href=\"https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap\" rel=\"stylesheet\">
<link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap\" rel=\"stylesheet\">

<link rel=\"shortcut icon\" href=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/favicon.png"), "html", null, true);
        yield "\" type=\"image/x-icon\">
<link rel=\"icon\" href=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/favicon.png"), "html", null, true);
        yield "\" type=\"image/x-icon\">

<!-- Responsive -->
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\">

</head>

<body>

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
\t\t\t\t\t\t\t<div class=\"logo\"><a href=\"";
        // line 69
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
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 86
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">About</a></li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">options</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Faq</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Price</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Testimonial</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">Team</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Team detail</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">Services</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feed</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 106
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Services detail</a></li>
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
        // line 122
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/flag.png"), "html", null, true);
        yield "\" alt=\"\" /></span> <span class=\"fa-solid fa-angle-down fa-fw\"></span>
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton1\">
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"";
        // line 125
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/flag.png"), "html", null, true);
        yield "\" alt=\"\" /></span> English</a></li>
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"";
        // line 126
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/arabic.png"), "html", null, true);
        yield "\" alt=\"\" /></span> Arbic</a></li>
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/germany.png"), "html", null, true);
        yield "\" alt=\"\" /></span> German</a></li>
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"";
        // line 128
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/france.png"), "html", null, true);
        yield "\" alt=\"\" /></span> French</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<!-- Button Box -->
\t\t\t\t\t\t\t<div class=\"main-header_buttons\">
\t\t\t\t\t\t\t\t";
        // line 134
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 134, $this->source); })()), "user", [], "any", false, false, false, 134)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 135
            yield "\t\t\t\t\t\t\t\t\t";
            // line 136
            yield "\t\t\t\t\t\t\t\t\t";
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 137
                yield "\t\t\t\t\t\t\t\t\t\t";
                // line 138
                yield "\t\t\t\t\t\t\t\t\t\t<a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_index");
                yield "\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t";
            } else {
                // line 145
                yield "\t\t\t\t\t\t\t\t\t\t";
                // line 146
                yield "\t\t\t\t\t\t\t\t\t\t<span class=\"welcome-text\">Welcome, ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 146, $this->source); })()), "user", [], "any", false, false, false, 146), "firstName", [], "any", false, false, false, 146) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 146, $this->source); })()), "user", [], "any", false, false, false, 146), "lastName", [], "any", false, false, false, 146))), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 146, $this->source); })()), "user", [], "any", false, false, false, 146), "email", [], "any", false, false, false, 146)), "html", null, true);
                yield "</span>
\t\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 147
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
                yield "\" style=\"display:inline-flex; align-items:center; justify-content:center; margin-right:8px; text-decoration:none;\">
\t\t\t\t\t\t\t\t\t\t\t";
                // line 148
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 148, $this->source); })()), "user", [], "any", false, false, false, 148), "photo", [], "any", false, false, false, 148)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 149
                    yield "\t\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/profiles/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 149, $this->source); })()), "user", [], "any", false, false, false, 149), "photo", [], "any", false, false, false, 149))), "html", null, true);
                    yield "\" 
\t\t\t\t\t\t\t\t\t\t\t\t\t style=\"width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid white; cursor:pointer;\">
\t\t\t\t\t\t\t\t\t\t\t";
                } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 151
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 151, $this->source); })()), "user", [], "any", false, false, false, 151), "avatar", [], "any", false, false, false, 151)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 152
                    yield "\t\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("Back_Office/assets/images/avatars/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 152, $this->source); })()), "user", [], "any", false, false, false, 152), "avatar", [], "any", false, false, false, 152))), "html", null, true);
                    yield "\" 
\t\t\t\t\t\t\t\t\t\t\t\t\t style=\"width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid white; cursor:pointer;\">
\t\t\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 155
                    yield "\t\t\t\t\t\t\t\t\t\t\t\t<div style=\"width:40px; height:40px; border-radius:50%; background:#7c3aed; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; border:2px solid white; cursor:pointer;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                    // line 156
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 156, $this->source); })()), "user", [], "any", false, false, false, 156), "firstName", [], "any", false, false, false, 156))), "html", null, true);
                    yield "
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 159
                yield "\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t";
            }
            // line 161
            yield "\t\t\t\t\t\t\t\t\t";
            // line 162
            yield "\t\t\t\t\t\t\t\t\t<a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Logout</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Logout</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t";
        } else {
            // line 169
            yield "\t\t\t\t\t\t\t\t\t";
            // line 170
            yield "\t\t\t\t\t\t\t\t\t<a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Login</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Login</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t<a href=\"";
            // line 176
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\" class=\"template-btn btn-style-one\">
\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Join now</span>
\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Join now</span>
\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t";
        }
        // line 183
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
        // line 204
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

\t\t\t\t<!-- Slide 1 -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url(";
        // line 220
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url(";
        // line 221
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url(";
        // line 222
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url(";
        // line 223
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-2.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url(";
        // line 224
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-4.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"";
        // line 230
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/hand.png"), "html", null, true);
        yield "\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Present your ideas in captivating live pitch sessions.</h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Shine in real time.</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 234
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
        // line 248
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-3.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<!-- Slider One Author -->
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"";
        // line 252
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
        // line 264
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/graph.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 267
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/image-1.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Slide 2 -->
\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t<div class=\"slider-one_icon\" style=\"background-image:url(";
        // line 277
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url(";
        // line 278
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url(";
        // line 279
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url(";
        // line 280
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-2.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url(";
        // line 281
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-4.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"";
        // line 287
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/hand.png"), "html", null, true);
        yield "\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Join a community of entrepreneurs, investors, and students.</h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Connect and innovate together</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 291
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
        // line 305
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-3.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"";
        // line 308
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-2.png"), "html", null, true);
        yield "\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Aamara Chiheb</h5>
\t\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author-text\">Video Editor</div>
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
        // line 320
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/graph.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 323
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
        // line 333
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_icon-two\" style=\"background-image:url(";
        // line 334
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern\" style=\"background-image:url(";
        // line 335
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-two\" style=\"background-image:url(";
        // line 336
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-2.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"slider-one_pattern-four\" style=\"background-image:url(";
        // line 337
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-4.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t<div class=\"auto-container\">
\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t<!-- Content Column -->
\t\t\t\t\t\t\t<div class=\"slider-one_content col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"slider-one_content-inner\">
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_title\"><i><img src=\"";
        // line 343
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/hand.png"), "html", null, true);
        yield "\" alt=\"\" /></i> AI makes content fast & easy</div>
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Take online courses and test your skills with interactive quizzes.</h1>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_text\">Learn at your own pace.</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_button d-flex align-items-center flex-wrap\">
\t\t\t\t\t\t\t\t\t\t<a href=\"";
        // line 347
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
        // line 361
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/pattern-3.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t<div class=\"slider-one_image-outer\">
\t\t\t\t\t\t\t\t\t<!-- Slider One Author -->
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"";
        // line 365
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/icon-2.png"), "html", null, true);
        yield "\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Laradh Youssef</h5>
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
        // line 377
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/main-slider/graph.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 380
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
\t
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
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"";
        // line 409
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Join community discussions, ask questions, share knowledge, and connect with other members in our interactive forum.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">01</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"";
        // line 413
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
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
\t\t\t\t\t\t<div class=\"service-block_one-text\">Stay updated with real-time feeds showcasing latest news, insights, and community highlights.</div>
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

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInUp\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-tag\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Report</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Utilize our dedicated complaint service to report any issues, ensuring prompt and effective resolution.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">05</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"#\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<!-- Service Block Two -->
\t\t\t\t<div class=\"service-block_two col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_two-inner wow fadeInRight\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_two-sideicon\" style=\"background-image:url(";
        // line 481
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/service-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t<div class=\"service-block_two-icon\">
\t\t\t\t\t\t\t<img src=\"";
        // line 483
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

\t<!-- About One -->
\t<section class=\"about-one\">
\t\t<div class=\"about-one_pattern\" style=\"background-image:url(";
        // line 505
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/about-pattern.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"about-one_icon\" style=\"background-image:url(";
        // line 506
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/about-1.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"about-one_icon-two\" style=\"background-image:url(";
        // line 507
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/about-2.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Tab Column -->
\t\t\t\t<div class=\"about-one_tab-column col-xl-6 col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"about-one_tab-outer\">
\t\t\t\t\t\t<div class=\"about-one_tab-shadow\" style=\"background-image:url(";
        // line 514
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/tab-shadow.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t<div class=\"about-one_tab-image\">
\t\t\t\t\t\t\t<img src=\"";
        // line 516
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
\t\t\t\t\t\t<p>At our platform, <span>entrepreneurs, investors, and students</span> we empower by combining expert-led courses, live pitch events, and a collaborative community to fuel innovation and drive success.</p>
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
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">More than 500,000 interactions on social media</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"300ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-instagram fa-fw\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"200000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">More than 200,000 community members</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Choose One -->
\t
\t<!-- Answer One -->
\t<section class=\"answer-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Title Column -->
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

\t\t\t\t<!-- Image Column -->
\t\t\t\t<div class=\"answer-one_content-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t<div class=\"answer-one_content-outer\">
\t\t\t\t\t\t<div class=\"answer-one_pattern\" style=\"background-image:url(";
        // line 633
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/faq-shadow.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t<div class=\"answer-one_image\">
\t\t\t\t\t\t\t<img src=\"";
        // line 635
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
        // line 648
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
        // line 672
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
        // line 695
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
        // line 718
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
        // line 740
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/step-1_bg.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"steps-one_icon\" style=\"background-image:url(";
        // line 741
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
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Join Community</h5>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-text\">Sign up as an entrepreneur, investor, or student and create your profile.</div>
\t\t\t\t\t\t\t\t<div class=\"step-block_one-content\">
\t\t\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 774
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
        // line 791
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
        // line 805
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
        // line 820
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
\t\t\t\t\t\t<!-- Tab Monthly -->
\t\t\t\t\t\t<div class=\"tab active-tab\" id=\"prod-monthly\">
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Starter -->
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
        // line 857
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

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Professional -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one active col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-one_stars\" style=\"background-image:url(";
        // line 873
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
        // line 882
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Full access to all courses & quizzes</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Attend live pitch sessions</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Priority support</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Join community discussions</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Investor -->
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
        // line 906
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Full access to all courses & quizzes</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Direct communication with entrepreneurs</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to advanced analytics & startup reports</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Exclusive invitations to premium events</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Tab Yearly -->
\t\t\t\t\t\t<div class=\"tab\" id=\"prod-yearly\">
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t\t\t<!-- Price Block One - Starter -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Starter</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Up to 2,000 words / mo</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>3<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"";
        // line 937
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Up to 10,000 words</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to AI copywriting tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advance 700+ tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Professional -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one active col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-one_stars\" style=\"background-image:url(";
        // line 953
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/price-stars.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Professional</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Up to 10,000 words / mo</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>9<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"";
        // line 962
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Up to 10,000 words</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to AI copywriting tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advance 700+ tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Enterprise -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Enterprise</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Up to 10,000 words / mo</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>18<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"";
        // line 986
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Up to 10,000 words</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to AI copywriting tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advance 700+ tools</li>
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
\t
\t<!-- Faq One -->
\t<section class=\"faq-one\">
\t\t<div class=\"faq-one_bg\" style=\"background-image:url(";
        // line 1012
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/faq-bg.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"faq-one_icon\" style=\"background-image:url(";
        // line 1013
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/step.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Title Column -->
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

\t\t\t\t<!-- Accordion Column -->
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
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Our platform connects entrepreneurs, investors, and students in one dynamic space where ideas can be pitched, skills can be learned, and collaborations can flourish.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>How can I participate in a pitch session?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Simply create an entrepreneur account, complete your profile, and register for upcoming pitch events. You'll receive a schedule and link to join the live session.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Are courses free?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">We offer a mix of free and premium courses. You can start with basic content under the Starter Plan, then upgrade to access full e-learning materials and quizzes.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Can investors contact entrepreneurs directly?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"text\">Yes, investors with an active subscription can view entrepreneur profiles and pitch decks, and initiate conversations directly through our messaging system.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Do I need experience to join?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"text\">Not at all! Whether you're a beginner or a seasoned professional, our platform is designed to support and guide you at every stage of your journey.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t</ul>

\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Faq One -->

\t<!-- Social One -->
\t<section class=\"social-one\">
\t\t<div class=\"social-one_bg-shadow\" style=\"background-image:url(";
        // line 1103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/social-bg.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<!-- Sec Title -->
\t\t\t<div class=\"sec-title centered\">
\t\t\t\t<div class=\"sec-title_title\">Integrations</div>
\t\t\t\t<h2 class=\"sec-title_heading\">Incorporate our tool into <br> <span>your everyday tasks</span></h2>
\t\t\t</div>
\t\t\t<div class=\"social-one_logo\">
\t\t\t\t<span><img src=\"";
        // line 1111
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-logo.png"), "html", null, true);
        yield "\" alt=\"\" /></span>
\t\t\t</div>
\t\t\t<div class=\"inner-container\">
\t\t\t\t<div class=\"social-one_bg\" style=\"background-image:url(";
        // line 1114
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/social-one_pattern.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t<div class=\"social-one_bg-two\" style=\"background-image:url(";
        // line 1115
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/social-one_pattern-two.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t
\t\t\t\t<div class=\"social-box_one\">
\t\t\t\t\t<div class=\"animation_mode\">
\t\t\t\t\t\t<!-- Icon 1 to 7 -->
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1120
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-1.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1121
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-2.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1122
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-3.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1123
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-4.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1124
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-5.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1125
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-6.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1126
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-7.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"social-box\">
\t\t\t\t\t<div class=\"animation_mode_two\">
\t\t\t\t\t\t<!-- Icon 8 to 14 -->
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1133
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-8.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1134
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-9.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1135
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-10.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1136
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-11.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1137
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-12.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1138
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-13.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"";
        // line 1139
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/social-14.png"), "html", null, true);
        yield "\" alt=\"\" /></a></div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Social One -->

\t<!-- News One -->
\t<section class=\"news-one\">
\t\t<div class=\"news-one_shadow\" style=\"background-image:url(";
        // line 1150
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/news-shadow-1.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"news-one_shadow-two\" style=\"background-image:url(";
        // line 1151
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/news-shadow-2.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<!-- Sec Title -->
\t\t\t<div class=\"sec-title title-anim centered\">
\t\t\t\t<div class=\"sec-title_title\">our courses</div>
\t\t\t\t<h2 class=\"sec-title_heading\">join our latest <span>courses</span></h2>
\t\t\t</div>
\t\t\t<div class=\"three-item_carousel swiper-container\">
\t\t\t\t<div class=\"swiper-wrapper\">
\t
\t\t\t\t\t<!-- Slide 1 -->
\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t<div class=\"news-block_one\">
\t\t\t\t\t\t\t<div class=\"news-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"news-block_one-image\">
\t\t\t\t\t\t\t\t\t<a href=\"#\"><img src=\"";
        // line 1166
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/news-1.jpg"), "html", null, true);
        yield "\" alt=\"\" /></a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"news-block_one-content\">
\t\t\t\t\t\t\t\t\t<h5 class=\"news-block_one-title\"><a href=\"#\">Transforming industries and shaping the future</a></h5>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis ligula consectetur.</div>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-button\">
\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Slide 2 -->
\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t<div class=\"news-block_one\">
\t\t\t\t\t\t\t<div class=\"news-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"news-block_one-image\">
\t\t\t\t\t\t\t\t\t<a href=\"#\"><img src=\"";
        // line 1189
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/news-2.jpg"), "html", null, true);
        yield "\" alt=\"\" /></a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"news-block_one-content\">
\t\t\t\t\t\t\t\t\t<h5 class=\"news-block_one-title\"><a href=\"#\">Exploring the cutting edge of artificial intelligence</a></h5>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis ligula consectetur.</div>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-button\">
\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Slide 3 -->
\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t<div class=\"news-block_one\">
\t\t\t\t\t\t\t<div class=\"news-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"news-block_one-image\">
\t\t\t\t\t\t\t\t\t<a href=\"#\"><img src=\"";
        // line 1212
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/news-3.jpg"), "html", null, true);
        yield "\" alt=\"\" /></a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"news-block_one-content\">
\t\t\t\t\t\t\t\t\t<h5 class=\"news-block_one-title\"><a href=\"#\">Understanding the basics of artificial intelligence</a></h5>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis ligula consectetur.</div>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-button\">
\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t\t<!-- Pagination -->
\t\t\t\t<div class=\"three-item_carousel-pagination\"></div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End News One -->

\t<!-- CTA One -->
\t<section class=\"cta-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<div class=\"cta-icon_one\" style=\"background-image:url(";
        // line 1242
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/cta-icon-1.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t<div class=\"cta-icon_two\" style=\"background-image:url(";
        // line 1243
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/cta-icon-2.png"), "html", null, true);
        yield ")\"></div>
\t\t\t\t<div class=\"cta-one_card\">
\t\t\t\t\t<img src=\"";
        // line 1245
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/cta-card.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t</div>
\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t<!-- Title Column -->
\t\t\t\t\t<div class=\"cta-one_title-column col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t\t<div class=\"cta-one_title-outer\">
\t\t\t\t\t\t\t<h2 class=\"cta-one_title\">Craft your great <span>future</span></h2>
\t\t\t\t\t\t\t<div class=\"cta-one_button\">
\t\t\t\t\t\t\t\t<a href=\"";
        // line 1253
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"template-btn btn-style-three\">
\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t<div class=\"cta-one_image-column col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t\t<div class=\"cta-one_image-outer\">
\t\t\t\t\t\t\t<div class=\"cta-one_cards\">
\t\t\t\t\t\t\t\t<img src=\"";
        // line 1266
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/icons/cta-cards.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t<img src=\"";
        // line 1269
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/resource/cta.png"), "html", null, true);
        yield "\" alt=\"\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End CTA One -->

\t<!-- Main Footer -->
\t<footer class=\"main-footer\">
\t\t<div class=\"footer_pattern\" style=\"background-image: url(";
        // line 1281
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/background/footer-pattern.png"), "html", null, true);
        yield ")\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Widgets Section -->
\t\t\t\t<div class=\"widgets-section\">
\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t
\t\t\t\t\t\t<!-- Big Column Newsletter -->
\t\t\t\t\t\t<div class=\"big-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-newsletter\">
\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Newsletter</h5>
\t\t\t\t\t\t\t\t<div class=\"footer-newsletter_text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis.</div>
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

\t\t\t\t\t\t<!-- Big Column Links -->
\t\t\t\t\t\t<div class=\"big-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-lists_outer\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-5 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Services</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feeds</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Report / Complaints</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-3 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Resources</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Blog</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">FAQs</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Help center</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Case studies</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-4 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">About Us</h5>
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
        // line 1353
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\"><img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/logo.svg"), "html", null, true);
        yield "\" alt=\"\" title=\"\"></a></div>
\t\t\t\t\t<div class=\"footer-copyright\">&copy; 2025 Braine. All rights reserved.</div>
\t\t\t\t\t<!-- Social Box -->
\t\t\t\t\t<div class=\"footer-social_box\">
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-facebook-f\"></i></a>
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-twitter\"></i></a>
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-youtube\"></i></a>
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-instagram\"></i></a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</footer>

</div>
<!-- End PageWrapper -->

<div class=\"progress-wrap\">
\t<svg class=\"progress-circle svg-content\" width=\"100%\" height=\"100%\" viewBox=\"-1 -1 102 102\">
\t\t<path d=\"M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98\"/>
\t</svg>
</div>

<!-- Scripts -->
<script src=\"";
        // line 1377
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1378
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/popper.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1379
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/bootstrap.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1380
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/appear.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1381
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/parallax.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1382
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/tilt.jquery.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1383
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.paroller.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1384
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/wow.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1385
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/swiper.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1386
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/backtotop.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1387
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/odometer.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1388
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/parallax-scroll.js"), "html", null, true);
        yield "\"></script>

<script src=\"";
        // line 1390
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/gsap.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1391
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/SplitText.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1392
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/ScrollTrigger.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1393
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/ScrollToPlugin.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1394
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/ScrollSmoother.min.js"), "html", null, true);
        yield "\"></script>

<script src=\"";
        // line 1396
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/touchspin.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1397
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.marquee.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1398
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/magnific-popup.min.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1399
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/nav-tool.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1400
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery-ui.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1401
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/element-in-view.js"), "html", null, true);
        yield "\"></script>
<script src=\"";
        // line 1402
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/script.js"), "html", null, true);
        yield "\"></script>

</body>
</html>
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
        return "page/index.html.twig";
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
        return array (  1952 => 1402,  1948 => 1401,  1944 => 1400,  1940 => 1399,  1936 => 1398,  1932 => 1397,  1928 => 1396,  1923 => 1394,  1919 => 1393,  1915 => 1392,  1911 => 1391,  1907 => 1390,  1902 => 1388,  1898 => 1387,  1894 => 1386,  1890 => 1385,  1886 => 1384,  1882 => 1383,  1878 => 1382,  1874 => 1381,  1870 => 1380,  1866 => 1379,  1862 => 1378,  1858 => 1377,  1829 => 1353,  1754 => 1281,  1739 => 1269,  1733 => 1266,  1717 => 1253,  1706 => 1245,  1701 => 1243,  1697 => 1242,  1664 => 1212,  1638 => 1189,  1612 => 1166,  1594 => 1151,  1590 => 1150,  1576 => 1139,  1572 => 1138,  1568 => 1137,  1564 => 1136,  1560 => 1135,  1556 => 1134,  1552 => 1133,  1542 => 1126,  1538 => 1125,  1534 => 1124,  1530 => 1123,  1526 => 1122,  1522 => 1121,  1518 => 1120,  1510 => 1115,  1506 => 1114,  1500 => 1111,  1489 => 1103,  1396 => 1013,  1392 => 1012,  1363 => 986,  1336 => 962,  1324 => 953,  1305 => 937,  1271 => 906,  1244 => 882,  1232 => 873,  1213 => 857,  1173 => 820,  1155 => 805,  1138 => 791,  1118 => 774,  1082 => 741,  1078 => 740,  1053 => 718,  1027 => 695,  1001 => 672,  974 => 648,  958 => 635,  953 => 633,  833 => 516,  828 => 514,  818 => 507,  814 => 506,  810 => 505,  785 => 483,  780 => 481,  709 => 413,  702 => 409,  670 => 380,  664 => 377,  649 => 365,  642 => 361,  625 => 347,  618 => 343,  609 => 337,  605 => 336,  601 => 335,  597 => 334,  593 => 333,  580 => 323,  574 => 320,  559 => 308,  553 => 305,  536 => 291,  529 => 287,  520 => 281,  516 => 280,  512 => 279,  508 => 278,  504 => 277,  491 => 267,  485 => 264,  470 => 252,  463 => 248,  446 => 234,  439 => 230,  430 => 224,  426 => 223,  422 => 222,  418 => 221,  414 => 220,  393 => 204,  370 => 183,  360 => 176,  350 => 170,  348 => 169,  337 => 162,  335 => 161,  331 => 159,  325 => 156,  322 => 155,  315 => 152,  313 => 151,  307 => 149,  305 => 148,  301 => 147,  296 => 146,  294 => 145,  283 => 138,  281 => 137,  278 => 136,  276 => 135,  274 => 134,  265 => 128,  261 => 127,  257 => 126,  253 => 125,  247 => 122,  228 => 106,  205 => 86,  183 => 69,  132 => 21,  128 => 20,  120 => 15,  116 => 14,  112 => 13,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Braine Digital Agency Business HTML-5 Template | Homepage 01{% endblock %}

{% block body %}
<!DOCTYPE html>
<html>
<head>
<meta charset=\"utf-8\">
<title>Braine Digital Agency Business HTML-5 Template | Homepage 01</title>
<!-- Stylesheets -->
<link href=\"{{ asset('assets_front/css/bootstrap.css') }}\" rel=\"stylesheet\">
<link href=\"{{ asset('assets_front/css/style.css') }}\" rel=\"stylesheet\">
<link href=\"{{ asset('assets_front/css/meanmenu.min.css') }}\" rel=\"stylesheet\">
<link href=\"{{ asset('assets_front/css/responsive.css') }}\" rel=\"stylesheet\">

<link href=\"https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap\" rel=\"stylesheet\">
<link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap\" rel=\"stylesheet\">

<link rel=\"shortcut icon\" href=\"{{ asset('assets_front/images/favicon.png') }}\" type=\"image/x-icon\">
<link rel=\"icon\" href=\"{{ asset('assets_front/images/favicon.png') }}\" type=\"image/x-icon\">

<!-- Responsive -->
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\">

</head>

<body>

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
\t\t\t\t\t\t\t\t\t\t<li><a href=\"{{ path('app_homepage') }}\">Home</a></li>
\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">About</a></li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">options</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Faq</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Price</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Testimonial</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">Team</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Team detail</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\">Services</a>
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feed</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"{{ path('forum_index') }}\">Forum</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Services detail</a></li>
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
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"{{ asset('assets_front/images/icons/germany.png') }}\" alt=\"\" /></span> German</a></li>
\t\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\"><span class=\"flag\"><img src=\"{{ asset('assets_front/images/icons/france.png') }}\" alt=\"\" /></span> French</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<!-- Button Box -->
\t\t\t\t\t\t\t<div class=\"main-header_buttons\">
\t\t\t\t\t\t\t\t{% if app.user %}
\t\t\t\t\t\t\t\t\t{# User is logged in #}
\t\t\t\t\t\t\t\t\t{% if is_granted('ROLE_ADMIN') %}
\t\t\t\t\t\t\t\t\t\t{# Admin user - show Dashboard button #}
\t\t\t\t\t\t\t\t\t\t<a href=\"{{ path('dashboard_index') }}\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Dashboard</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t\t{# Regular user/student - show welcome message #}
\t\t\t\t\t\t\t\t\t\t<span class=\"welcome-text\">Welcome, {{ (app.user.firstName ~ ' ' ~ app.user.lastName)|trim|default(app.user.email) }}</span>
\t\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_profile') }}\" style=\"display:inline-flex; align-items:center; justify-content:center; margin-right:8px; text-decoration:none;\">
\t\t\t\t\t\t\t\t\t\t\t{% if app.user.photo %}
\t\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('uploads/profiles/' ~ app.user.photo) }}\" 
\t\t\t\t\t\t\t\t\t\t\t\t\t style=\"width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid white; cursor:pointer;\">
\t\t\t\t\t\t\t\t\t\t\t{% elseif app.user.avatar %}
\t\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset('Back_Office/assets/images/avatars/' ~ app.user.avatar) }}\" 
\t\t\t\t\t\t\t\t\t\t\t\t\t style=\"width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid white; cursor:pointer;\">
\t\t\t\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t\t\t\t<div style=\"width:40px; height:40px; border-radius:50%; background:#7c3aed; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; border:2px solid white; cursor:pointer;\">
\t\t\t\t\t\t\t\t\t\t\t\t\t{{ app.user.firstName|first|upper }}
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t\t\t{# Show logout button for all logged-in users #}
\t\t\t\t\t\t\t\t\t<a href=\"{{ path('app_logout') }}\" class=\"template-btn btn-style-one\">
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

\t\t\t\t<!-- Slide 1 -->
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
\t\t\t\t\t\t\t\t\t<h1 class=\"slider-one_heading\">Present your ideas in captivating live pitch sessions.</h1>
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
\t\t\t\t\t\t\t\t\t<!-- Slider One Author -->
\t\t\t\t\t\t\t\t\t<div class=\"slider-one_author\">
\t\t\t\t\t\t\t\t\t\t<i><img src=\"{{ asset('assets_front/images/main-slider/icon-2.png') }}\" alt=\"\" /></i>
\t\t\t\t\t\t\t\t\t\t<h5 class=\"slider-one_author-name\">Laradh Youssef</h5>
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
\t
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
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"{{ path('forum_index') }}\">Forum</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Join community discussions, ask questions, share knowledge, and connect with other members in our interactive forum.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">01</div>
\t\t\t\t\t\t\t<a class=\"service-block_one-join\" href=\"{{ path('forum_index') }}\">Join now <i class=\"fa-solid fa-plus fa-fw\"></i></a>
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
\t\t\t\t\t\t<div class=\"service-block_one-text\">Stay updated with real-time feeds showcasing latest news, insights, and community highlights.</div>
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

\t\t\t\t<!-- Service Block One -->
\t\t\t\t<div class=\"service-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t<div class=\"service-block_one-inner wow fadeInUp\" data-wow-delay=\"0ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t<div class=\"service-block_one-icon\">
\t\t\t\t\t\t\t<i class=\"icon-tag\"></i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<h5 class=\"service-block_one-heading\"><a href=\"#\">Report</a></h5>
\t\t\t\t\t\t<div class=\"service-block_one-text\">Utilize our dedicated complaint service to report any issues, ensuring prompt and effective resolution.</div>
\t\t\t\t\t\t<div class=\"lower-box d-flex justify-content-between align-items-center flex-wrap\">
\t\t\t\t\t\t\t<div class=\"service-block_one-number\">05</div>
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
\t\t\t\t\t\t<p>At our platform, <span>entrepreneurs, investors, and students</span> we empower by combining expert-led courses, live pitch events, and a collaborative community to fuel innovation and drive success.</p>
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
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">More than 500,000 interactions on social media</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Counter Block One -->
\t\t\t\t\t<div class=\"counter-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t<div class=\"counter-block_one-inner wow fadeInLeft\" data-wow-delay=\"300ms\" data-wow-duration=\"1500ms\">
\t\t\t\t\t\t\t<div class=\"counter-block_one-icon fa-brands fa-instagram fa-fw\"></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-count\"><span class=\"odometer\" data-count=\"200000\"></span><i>+</i></div>
\t\t\t\t\t\t\t<div class=\"counter-block_one-text\">More than 200,000 community members</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Choose One -->
\t
\t<!-- Answer One -->
\t<section class=\"answer-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Title Column -->
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

\t\t\t\t<!-- Image Column -->
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
\t\t\t\t\t\t\t\t<h5 class=\"step-block_one-title\">Join Community</h5>
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
\t\t\t\t\t\t<!-- Tab Monthly -->
\t\t\t\t\t\t<div class=\"tab active-tab\" id=\"prod-monthly\">
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Starter -->
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

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Professional -->
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
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Join community discussions</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Investor -->
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
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to advanced analytics & startup reports</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Exclusive invitations to premium events</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<!-- Tab Yearly -->
\t\t\t\t\t\t<div class=\"tab\" id=\"prod-yearly\">
\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t\t\t<!-- Price Block One - Starter -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Starter</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Up to 2,000 words / mo</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>3<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"{{ path('app_register') }}\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Up to 10,000 words</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to AI copywriting tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advance 700+ tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Professional -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one active col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-one_stars\" style=\"background-image:url({{ asset('assets_front/images/icons/price-stars.png') }})\"></div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Professional</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Up to 10,000 words / mo</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>9<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"{{ path('app_register') }}\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Up to 10,000 words</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to AI copywriting tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advance 700+ tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t<!-- Price Block One - Enterprise -->
\t\t\t\t\t\t\t\t\t<div class=\"price-block_one col-lg-4 col-md-6 col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-inner\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-title\">Enterprise</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-subtitle\">Up to 10,000 words / mo</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-content\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-between align-items-end flex-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-price\"><sup>\$</sup>18<sub>/mo</sub></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-text\">*Get Braine tailored</div>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"price-block_one-button\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"template-btn price-one_button\" href=\"{{ path('app_register') }}\">Start 1 month free trial</a>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"price-block_one-list\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Up to 10,000 words</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to basic tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Access to AI copywriting tools</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Email support only</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li><i class=\"fa-solid fa-check fa-fw\"></i>Advance 700+ tools</li>
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
\t
\t<!-- Faq One -->
\t<section class=\"faq-one\">
\t\t<div class=\"faq-one_bg\" style=\"background-image:url({{ asset('assets_front/images/background/faq-bg.png') }})\"></div>
\t\t<div class=\"faq-one_icon\" style=\"background-image:url({{ asset('assets_front/images/icons/step.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"row clearfix\">

\t\t\t\t<!-- Title Column -->
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

\t\t\t\t<!-- Accordion Column -->
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
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Our platform connects entrepreneurs, investors, and students in one dynamic space where ideas can be pitched, skills can be learned, and collaborations can flourish.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>How can I participate in a pitch session?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">Simply create an entrepreneur account, complete your profile, and register for upcoming pitch events. You'll receive a schedule and link to join the live session.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Are courses free?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"content\">
\t\t\t\t\t\t\t\t\t\t<div class=\"text\">We offer a mix of free and premium courses. You can start with basic content under the Starter Plan, then upgrade to access full e-learning materials and quizzes.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Can investors contact entrepreneurs directly?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"text\">Yes, investors with an active subscription can view entrepreneur profiles and pitch decks, and initiate conversations directly through our messaging system.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t<!-- Block -->
\t\t\t\t\t\t\t<li class=\"accordion block\">
\t\t\t\t\t\t\t\t<div class=\"acc-btn\"><div class=\"icon-outer\"><span class=\"icon icon-plus fa-solid fa-plus fa-fw\"></span></div>Do I need experience to join?</div>
\t\t\t\t\t\t\t\t<div class=\"acc-content\">
\t\t\t\t\t\t\t\t\t<div class=\"text\">Not at all! Whether you're a beginner or a seasoned professional, our platform is designed to support and guide you at every stage of your journey.</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t</ul>

\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Faq One -->

\t<!-- Social One -->
\t<section class=\"social-one\">
\t\t<div class=\"social-one_bg-shadow\" style=\"background-image:url({{ asset('assets_front/images/background/social-bg.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<!-- Sec Title -->
\t\t\t<div class=\"sec-title centered\">
\t\t\t\t<div class=\"sec-title_title\">Integrations</div>
\t\t\t\t<h2 class=\"sec-title_heading\">Incorporate our tool into <br> <span>your everyday tasks</span></h2>
\t\t\t</div>
\t\t\t<div class=\"social-one_logo\">
\t\t\t\t<span><img src=\"{{ asset('assets_front/images/icons/social-logo.png') }}\" alt=\"\" /></span>
\t\t\t</div>
\t\t\t<div class=\"inner-container\">
\t\t\t\t<div class=\"social-one_bg\" style=\"background-image:url({{ asset('assets_front/images/background/social-one_pattern.png') }})\"></div>
\t\t\t\t<div class=\"social-one_bg-two\" style=\"background-image:url({{ asset('assets_front/images/background/social-one_pattern-two.png') }})\"></div>
\t\t\t\t
\t\t\t\t<div class=\"social-box_one\">
\t\t\t\t\t<div class=\"animation_mode\">
\t\t\t\t\t\t<!-- Icon 1 to 7 -->
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-1.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-2.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-3.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-4.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-5.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-6.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-7.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"social-box\">
\t\t\t\t\t<div class=\"animation_mode_two\">
\t\t\t\t\t\t<!-- Icon 8 to 14 -->
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-8.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-9.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-10.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-11.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-12.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-13.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t\t<div class=\"social_icon-box\"><a href=\"#\"><img src=\"{{ asset('assets_front/images/icons/social-14.png') }}\" alt=\"\" /></a></div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End Social One -->

\t<!-- News One -->
\t<section class=\"news-one\">
\t\t<div class=\"news-one_shadow\" style=\"background-image:url({{ asset('assets_front/images/background/news-shadow-1.png') }})\"></div>
\t\t<div class=\"news-one_shadow-two\" style=\"background-image:url({{ asset('assets_front/images/background/news-shadow-2.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<!-- Sec Title -->
\t\t\t<div class=\"sec-title title-anim centered\">
\t\t\t\t<div class=\"sec-title_title\">our courses</div>
\t\t\t\t<h2 class=\"sec-title_heading\">join our latest <span>courses</span></h2>
\t\t\t</div>
\t\t\t<div class=\"three-item_carousel swiper-container\">
\t\t\t\t<div class=\"swiper-wrapper\">
\t
\t\t\t\t\t<!-- Slide 1 -->
\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t<div class=\"news-block_one\">
\t\t\t\t\t\t\t<div class=\"news-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"news-block_one-image\">
\t\t\t\t\t\t\t\t\t<a href=\"#\"><img src=\"{{ asset('assets_front/images/resource/news-1.jpg') }}\" alt=\"\" /></a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"news-block_one-content\">
\t\t\t\t\t\t\t\t\t<h5 class=\"news-block_one-title\"><a href=\"#\">Transforming industries and shaping the future</a></h5>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis ligula consectetur.</div>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-button\">
\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Slide 2 -->
\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t<div class=\"news-block_one\">
\t\t\t\t\t\t\t<div class=\"news-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"news-block_one-image\">
\t\t\t\t\t\t\t\t\t<a href=\"#\"><img src=\"{{ asset('assets_front/images/resource/news-2.jpg') }}\" alt=\"\" /></a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"news-block_one-content\">
\t\t\t\t\t\t\t\t\t<h5 class=\"news-block_one-title\"><a href=\"#\">Exploring the cutting edge of artificial intelligence</a></h5>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis ligula consectetur.</div>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-button\">
\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<!-- Slide 3 -->
\t\t\t\t\t<div class=\"swiper-slide\">
\t\t\t\t\t\t<div class=\"news-block_one\">
\t\t\t\t\t\t\t<div class=\"news-block_one-inner\">
\t\t\t\t\t\t\t\t<div class=\"news-block_one-image\">
\t\t\t\t\t\t\t\t\t<a href=\"#\"><img src=\"{{ asset('assets_front/images/resource/news-3.jpg') }}\" alt=\"\" /></a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"news-block_one-content\">
\t\t\t\t\t\t\t\t\t<h5 class=\"news-block_one-title\"><a href=\"#\">Understanding the basics of artificial intelligence</a></h5>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis ligula consectetur.</div>
\t\t\t\t\t\t\t\t\t<div class=\"news-block_one-button\">
\t\t\t\t\t\t\t\t\t\t<a href=\"#\" class=\"template-btn btn-style-two\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Read more</span>
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t</div>
\t\t\t\t<!-- Pagination -->
\t\t\t\t<div class=\"three-item_carousel-pagination\"></div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End News One -->

\t<!-- CTA One -->
\t<section class=\"cta-one\">
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<div class=\"cta-icon_one\" style=\"background-image:url({{ asset('assets_front/images/icons/cta-icon-1.png') }})\"></div>
\t\t\t\t<div class=\"cta-icon_two\" style=\"background-image:url({{ asset('assets_front/images/icons/cta-icon-2.png') }})\"></div>
\t\t\t\t<div class=\"cta-one_card\">
\t\t\t\t\t<img src=\"{{ asset('assets_front/images/icons/cta-card.png') }}\" alt=\"\" />
\t\t\t\t</div>
\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t<!-- Title Column -->
\t\t\t\t\t<div class=\"cta-one_title-column col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t\t<div class=\"cta-one_title-outer\">
\t\t\t\t\t\t\t<h2 class=\"cta-one_title\">Craft your great <span>future</span></h2>
\t\t\t\t\t\t\t<div class=\"cta-one_button\">
\t\t\t\t\t\t\t\t<a href=\"{{ path('app_register') }}\" class=\"template-btn btn-style-three\">
\t\t\t\t\t\t\t\t\t<span class=\"btn-wrap\">
\t\t\t\t\t\t\t\t\t\t<span class=\"text-one\">Get started free</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"text-two\">Get started free</span>
\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- Image Column -->
\t\t\t\t\t<div class=\"cta-one_image-column col-lg-6 col-md-12 col-sm-12\">
\t\t\t\t\t\t<div class=\"cta-one_image-outer\">
\t\t\t\t\t\t\t<div class=\"cta-one_cards\">
\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/icons/cta-cards.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"image\">
\t\t\t\t\t\t\t\t<img src=\"{{ asset('assets_front/images/resource/cta.png') }}\" alt=\"\" />
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- End CTA One -->

\t<!-- Main Footer -->
\t<footer class=\"main-footer\">
\t\t<div class=\"footer_pattern\" style=\"background-image: url({{ asset('assets_front/images/background/footer-pattern.png') }})\"></div>
\t\t<div class=\"auto-container\">
\t\t\t<div class=\"inner-container\">
\t\t\t\t<!-- Widgets Section -->
\t\t\t\t<div class=\"widgets-section\">
\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t
\t\t\t\t\t\t<!-- Big Column Newsletter -->
\t\t\t\t\t\t<div class=\"big-column col-lg-5 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-newsletter\">
\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Newsletter</h5>
\t\t\t\t\t\t\t\t<div class=\"footer-newsletter_text\">Lorem ipsum dolor sit amet consectetur adipiscing vitae mattis tellus. Nullam quis mattis.</div>
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

\t\t\t\t\t\t<!-- Big Column Links -->
\t\t\t\t\t\t<div class=\"big-column col-lg-7 col-md-12 col-sm-12\">
\t\t\t\t\t\t\t<div class=\"footer-lists_outer\">
\t\t\t\t\t\t\t\t<div class=\"row clearfix\">
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-5 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Services</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Events</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Feeds</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Quiz</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Courses</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Report / Complaints</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-3 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">Resources</h5>
\t\t\t\t\t\t\t\t\t\t<ul class=\"footer-pages_list\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Blog</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">FAQs</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Help center</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#\">Case studies</a></li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"column col-lg-4 col-md-4 col-sm-6\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"footer-title\">About Us</h5>
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
\t\t\t\t\t<div class=\"footer-copyright\">&copy; 2025 Braine. All rights reserved.</div>
\t\t\t\t\t<!-- Social Box -->
\t\t\t\t\t<div class=\"footer-social_box\">
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-facebook-f\"></i></a>
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-twitter\"></i></a>
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-youtube\"></i></a>
\t\t\t\t\t\t<a href=\"#\"><i class=\"fa-brands fa-instagram\"></i></a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</footer>

</div>
<!-- End PageWrapper -->

<div class=\"progress-wrap\">
\t<svg class=\"progress-circle svg-content\" width=\"100%\" height=\"100%\" viewBox=\"-1 -1 102 102\">
\t\t<path d=\"M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98\"/>
\t</svg>
</div>

<!-- Scripts -->
<script src=\"{{ asset('assets_front/js/jquery.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/popper.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/bootstrap.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/appear.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/parallax.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/tilt.jquery.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/jquery.paroller.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/wow.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/swiper.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/backtotop.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/odometer.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/parallax-scroll.js') }}\"></script>

<script src=\"{{ asset('assets_front/js/gsap.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/SplitText.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/ScrollTrigger.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/ScrollToPlugin.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/ScrollSmoother.min.js') }}\"></script>

<script src=\"{{ asset('assets_front/js/touchspin.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/jquery.marquee.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/magnific-popup.min.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/nav-tool.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/jquery-ui.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/element-in-view.js') }}\"></script>
<script src=\"{{ asset('assets_front/js/script.js') }}\"></script>

</body>
</html>
{% endblock %}
", "page/index.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\page\\index.html.twig");
    }
}
