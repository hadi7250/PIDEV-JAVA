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

/* dashboard/user_form.html.twig */
class __TwigTemplate_c72bb5438ea1885071eb4078fdf18d73 extends Template
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
            'page_content' => [$this, 'block_page_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "dashboard/index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/user_form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/user_form.html.twig"));

        $this->parent = $this->load("dashboard/index.html.twig", 1);
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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 3, $this->source); })()), "html", null, true);
        yield " - Dashboard";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
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

        // line 6
        yield "<!--start page wrapper -->
<div class=\"page-wrapper\">
    <div class=\"page-content\">
        <!--breadcrumb-->
        <div class=\"breadcrumb-area\">
            <h1>";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 11, $this->source); })()), "html", null, true);
        yield "</h1>
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb mb-0\">
                    <li class=\"breadcrumb-item\"><a href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dashboard_index");
        yield "\">Home</a></li>
                    <li class=\"breadcrumb-item\"><a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
        yield "\">Utilisateurs</a></li>
                    <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 16, $this->source); })()), "html", null, true);
        yield "</li>
                </ol>
            </nav>
        </div>
        <!--end breadcrumb-->

        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"card\">
                    <div class=\"card-header\">
                        <h5 class=\"mb-0\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 26, $this->source); })()), "html", null, true);
        yield "</h5>
                    </div>
                    <div class=\"card-body\">
                        ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 29, $this->source); })()), "flashes", ["success"], "method", false, false, false, 29));
        foreach ($context['_seq'] as $context["_key"] => $context["flash_message"]) {
            // line 30
            yield "                            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                <i class=\"material-icons-outlined me-2\">check_circle</i>
                                ";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["flash_message"], "html", null, true);
            yield "
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['flash_message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "
                        ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 37, $this->source); })()), "flashes", ["error"], "method", false, false, false, 37));
        foreach ($context['_seq'] as $context["_key"] => $context["flash_message"]) {
            // line 38
            yield "                            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                                <i class=\"material-icons-outlined me-2\">error</i>
                                ";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["flash_message"], "html", null, true);
            yield "
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['flash_message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        yield "
                        ";
        // line 45
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 45, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        yield "
                        
                        <!-- Section 1: First Name and Last Name -->
                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                ";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 50, $this->source); })()), "firstName", [], "any", false, false, false, 50), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "First Name"]);
        yield "
                                ";
        // line 51
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "firstName", [], "any", false, false, false, 51), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "John"]]);
        yield "
                                ";
        // line 52
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "firstName", [], "any", false, false, false, 52), 'errors');
        yield "
                            </div>
                            
                            <div class=\"col-md-6\">
                                ";
        // line 56
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 56, $this->source); })()), "lastName", [], "any", false, false, false, 56), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "Last Name"]);
        yield "
                                ";
        // line 57
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 57, $this->source); })()), "lastName", [], "any", false, false, false, 57), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "Doe"]]);
        yield "
                                ";
        // line 58
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), "lastName", [], "any", false, false, false, 58), 'errors');
        yield "
                            </div>
                        </div>
                        
                        <!-- Section 2: Age and Email -->
                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                ";
        // line 65
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 65, $this->source); })()), "age", [], "any", false, false, false, 65), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "Age"]);
        yield "
                                ";
        // line 66
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 66, $this->source); })()), "age", [], "any", false, false, false, 66), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "25"]]);
        yield "
                                ";
        // line 67
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), "age", [], "any", false, false, false, 67), 'errors');
        yield "
                            </div>
                            
                            <div class=\"col-md-6\">
                                ";
        // line 71
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 71, $this->source); })()), "email", [], "any", false, false, false, 71), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "Email"]);
        yield "
                                ";
        // line 72
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "email", [], "any", false, false, false, 72), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "john.doe@example.com"]]);
        yield "
                                ";
        // line 73
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 73, $this->source); })()), "email", [], "any", false, false, false, 73), 'errors');
        yield "
                            </div>
                        </div>
                        
                        <!-- Section 3: Username (optional) -->
                        <div class=\"row mb-4\">
                            <div class=\"col-12\">
                                ";
        // line 80
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 80, $this->source); })()), "username", [], "any", false, false, false, 80), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "Username"]);
        yield "
                                ";
        // line 81
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 81, $this->source); })()), "username", [], "any", false, false, false, 81), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "johndoe (optional)"]]);
        yield "
                                ";
        // line 82
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 82, $this->source); })()), "username", [], "any", false, false, false, 82), 'errors');
        yield "
                            </div>
                        </div>
                        
                        <!-- Section 4: Password (only for add) -->
                        ";
        // line 87
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "plainPassword", [], "any", true, true, false, 87)) {
            // line 88
            yield "                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                ";
            // line 90
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 90, $this->source); })()), "plainPassword", [], "any", false, false, false, 90), 'label', ["label_attr" => ["class" => "form-label fw-semibold"]] + (CoreExtension::testEmpty($_label_ = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 90, $this->source); })()), "plainPassword", [], "any", false, false, false, 90), "vars", [], "any", false, false, false, 90), "label", [], "any", false, false, false, 90)) ? [] : ["label" => $_label_]));
            yield "
                                <small class=\"text-muted d-block mb-2\">Minimum 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre</small>
                                <div class=\"input-group\" id=\"show_hide_password\">
                                    ";
            // line 93
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 93, $this->source); })()), "plainPassword", [], "any", false, false, false, 93), 'widget', ["attr" => ["class" => "form-control border-end-0", "placeholder" => "Enter Password"]]);
            yield "
                                    <a href=\"javascript:;\" class=\"input-group-text bg-transparent\">
                                        <i class=\"fas fa-eye-slash\"></i>
                                    </a>
                                </div>
                                ";
            // line 98
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 98, $this->source); })()), "plainPassword", [], "any", false, false, false, 98), 'errors');
            yield "
                            </div>
                        </div>
                        ";
        }
        // line 102
        yield "                        
                        <!-- Section 4: Role and Status -->
                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                ";
        // line 106
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 106, $this->source); })()), "roles", [], "any", false, false, false, 106), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "Rôle"]);
        yield "
                                ";
        // line 107
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 107, $this->source); })()), "roles", [], "any", false, false, false, 107), 'widget', ["attr" => ["class" => "form-select"]]);
        yield "
                                ";
        // line 108
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 108, $this->source); })()), "roles", [], "any", false, false, false, 108), 'errors');
        yield "
                            </div>
                            
                            <div class=\"col-md-6\">
                                ";
        // line 112
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 112, $this->source); })()), "status", [], "any", false, false, false, 112), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "Statut"]);
        yield "
                                ";
        // line 113
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 113, $this->source); })()), "status", [], "any", false, false, false, 113), 'widget', ["attr" => ["class" => "form-select"]]);
        yield "
                                ";
        // line 114
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 114, $this->source); })()), "status", [], "any", false, false, false, 114), 'errors');
        yield "
                            </div>
                        </div>
                        
                        <!-- Section 5: Photo -->
                        <div class=\"row mb-4\">
                            <div class=\"col-12\">
                                ";
        // line 121
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 121, $this->source); })()), "photoFile", [], "any", false, false, false, 121), 'label', ["label_attr" => ["class" => "form-label fw-semibold"], "label" => "Photo de profil"]);
        yield "
                                <small class=\"text-muted d-block mb-2\">JPG/PNG, max 2Mo</small>
                                ";
        // line 123
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 123, $this->source); })()), "photoFile", [], "any", false, false, false, 123), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
                                ";
        // line 124
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 124, $this->source); })()), "photoFile", [], "any", false, false, false, 124), 'errors');
        yield "
                            </div>
                        </div>
                        
                        <!-- Section 6: Submit -->
                        <div class=\"border-top pt-4 mt-5\">
                            <div class=\"d-grid gap-3 d-md-flex justify-content-md-start\">
                                <button type=\"submit\" class=\"btn btn-primary\">
                                    <i class=\"material-icons-outlined me-2\">save</i>
                                    ";
        // line 133
        if (array_key_exists("user", $context)) {
            yield "Enregistrer les modifications";
        } else {
            yield "Créer l'utilisateur";
        }
        // line 134
        yield "                                </button>
                                <a href=\"";
        // line 135
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_users");
        yield "\" class=\"btn btn-secondary\">
                                    <i class=\"material-icons-outlined me-2\">cancel</i>
                                    Annuler
                                </a>
                            </div>
                        </div>
                        
                        ";
        // line 142
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 142, $this->source); })()), 'form_end');
        yield "
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper-->

<script>
\$(document).ready(function () {
    // Toggle password show/hide
    \$(\"#show_hide_password a\").on('click', function (event) {
        event.preventDefault();
        const input = \$('#show_hide_password input');
        const icon = \$('#show_hide_password i');
        if (input.attr(\"type\") === \"text\") {
            input.attr('type', 'password');
            icon.removeClass(\"fa-eye\").addClass(\"fa-eye-slash\");
        } else {
            input.attr('type', 'text');
            icon.removeClass(\"fa-eye-slash\").addClass(\"fa-eye\");
        }
    });

    // Validation functions
    function validateEmail(email) {
        const re = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
        return re.test(email);
    }

    function showError(input, message) {
        const \$input = \$(input);
        \$input.addClass('is-invalid');
        \$input.removeClass('shake');
        void \$input[0].offsetWidth; // force reflow
        \$input.addClass('shake');

        if (!\$input.next('.invalid-feedback').length) {
            \$input.after(`<div class=\"invalid-feedback\">\${message}</div>`);
        } else {
            \$input.next('.invalid-feedback').text(message);
        }
    }

    function clearError(input) {
        const \$input = \$(input);
        \$input.removeClass('is-invalid shake');
        \$input.next('.invalid-feedback').remove();
    }

    // Live validation on typing for Email
    \$('#user_form_email').on('input', function () {
        const email = \$(this).val().trim();
        if (email === '') {
            clearError(this);
        } else if (!email.includes('@')) {
            showError(this, \"Missing @ symbol.\");
        } else if (email.indexOf('@') !== email.lastIndexOf('@')) {
            showError(this, \"Only one @ symbol is allowed.\");
        } else if (email.split('@')[1].length < 1) {
            showError(this, \"Missing characters after @.\");
        } else if (email.split('@')[1] && !email.split('@')[1].includes('.')) {
            showError(this, \"Missing domain extension (e.g., .com).\");
        } else if (!validateEmail(email)) {
            showError(this, \"Enter a valid email.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for Password
    \$('#user_form_plainPassword').on('input', function () {
        const password = \$(this).val().trim();
        if (password === '') {
            clearError(this);
        } else if (password.length < 8) {
            showError(this, \"Le mot de passe doit contenir au moins 8 caractères.\");
        } else if (!/(?=.*[a-z])/.test(password)) {
            showError(this, \"Le mot de passe doit contenir au moins une minuscule.\");
        } else if (!/(?=.*[A-Z])/.test(password)) {
            showError(this, \"Le mot de passe doit contenir au moins une majuscule.\");
        } else if (!/(?=.*\\d)/.test(password)) {
            showError(this, \"Le mot de passe doit contenir au moins un chiffre.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for First Name
    \$('#user_form_firstName').on('input', function () {
        const firstName = \$(this).val().trim();
        if (firstName === '') {
            clearError(this);
        } else if (!/^[a-zA-Zàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñç\\s-]+\$/.test(firstName)) {
            showError(this, \"First name can only contain letters and spaces.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for Last Name
    \$('#user_form_lastName').on('input', function () {
        const lastName = \$(this).val().trim();
        if (lastName === '') {
            clearError(this);
        } else if (!/^[a-zA-Zàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñç\\s-]+\$/.test(lastName)) {
            showError(this, \"Last name can only contain letters and spaces.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for Age
    \$('#user_form_age').on('input', function () {
        const age = \$(this).val().trim();
        if (age === '') {
            clearError(this);
        } else if (isNaN(age) || age < 1 || age > 120) {
            showError(this, \"Age must be between 1 and 120.\");
        } else {
            clearError(this);
        }
    });
});
</script>

<style>
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-6px); }
    50% { transform: translateX(6px); }
    75% { transform: translateX(-6px); }
    100% { transform: translateX(0); }
}

.shake {
    animation: shake 0.3s;
}

.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.invalid-feedback {
    display: block !important;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-control {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
}

.form-select {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
}

.input-group-text {
    border: 2px solid #e0e0e0;
    border-left: none;
    background: transparent;
    color: #666;
}

.form-control.border-end-0 {
    border-right: none;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}
</style>
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
        return "dashboard/user_form.html.twig";
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
        return array (  379 => 142,  369 => 135,  366 => 134,  360 => 133,  348 => 124,  344 => 123,  339 => 121,  329 => 114,  325 => 113,  321 => 112,  314 => 108,  310 => 107,  306 => 106,  300 => 102,  293 => 98,  285 => 93,  279 => 90,  275 => 88,  273 => 87,  265 => 82,  261 => 81,  257 => 80,  247 => 73,  243 => 72,  239 => 71,  232 => 67,  228 => 66,  224 => 65,  214 => 58,  210 => 57,  206 => 56,  199 => 52,  195 => 51,  191 => 50,  183 => 45,  180 => 44,  170 => 40,  166 => 38,  162 => 37,  159 => 36,  149 => 32,  145 => 30,  141 => 29,  135 => 26,  122 => 16,  118 => 15,  114 => 14,  108 => 11,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'dashboard/index.html.twig' %}

{% block title %}{{ title }} - Dashboard{% endblock %}

{% block page_content %}
<!--start page wrapper -->
<div class=\"page-wrapper\">
    <div class=\"page-content\">
        <!--breadcrumb-->
        <div class=\"breadcrumb-area\">
            <h1>{{ title }}</h1>
            <nav aria-label=\"breadcrumb\">
                <ol class=\"breadcrumb mb-0\">
                    <li class=\"breadcrumb-item\"><a href=\"{{ path('dashboard_index') }}\">Home</a></li>
                    <li class=\"breadcrumb-item\"><a href=\"{{ path('admin_users') }}\">Utilisateurs</a></li>
                    <li class=\"breadcrumb-item active\" aria-current=\"page\">{{ title }}</li>
                </ol>
            </nav>
        </div>
        <!--end breadcrumb-->

        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"card\">
                    <div class=\"card-header\">
                        <h5 class=\"mb-0\">{{ title }}</h5>
                    </div>
                    <div class=\"card-body\">
                        {% for flash_message in app.flashes('success') %}
                            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                <i class=\"material-icons-outlined me-2\">check_circle</i>
                                {{ flash_message }}
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                            </div>
                        {% endfor %}

                        {% for flash_message in app.flashes('error') %}
                            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                                <i class=\"material-icons-outlined me-2\">error</i>
                                {{ flash_message }}
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                            </div>
                        {% endfor %}

                        {{ form_start(form, {attr: {novalidate: 'novalidate'}}) }}
                        
                        <!-- Section 1: First Name and Last Name -->
                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                {{ form_label(form.firstName, 'First Name', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                {{ form_widget(form.firstName, {'attr': {'class': 'form-control', 'placeholder': 'John'}}) }}
                                {{ form_errors(form.firstName) }}
                            </div>
                            
                            <div class=\"col-md-6\">
                                {{ form_label(form.lastName, 'Last Name', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                {{ form_widget(form.lastName, {'attr': {'class': 'form-control', 'placeholder': 'Doe'}}) }}
                                {{ form_errors(form.lastName) }}
                            </div>
                        </div>
                        
                        <!-- Section 2: Age and Email -->
                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                {{ form_label(form.age, 'Age', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                {{ form_widget(form.age, {'attr': {'class': 'form-control', 'placeholder': '25'}}) }}
                                {{ form_errors(form.age) }}
                            </div>
                            
                            <div class=\"col-md-6\">
                                {{ form_label(form.email, 'Email', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                {{ form_widget(form.email, {'attr': {'class': 'form-control', 'placeholder': 'john.doe@example.com'}}) }}
                                {{ form_errors(form.email) }}
                            </div>
                        </div>
                        
                        <!-- Section 3: Username (optional) -->
                        <div class=\"row mb-4\">
                            <div class=\"col-12\">
                                {{ form_label(form.username, 'Username', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                {{ form_widget(form.username, {'attr': {'class': 'form-control', 'placeholder': 'johndoe (optional)'}}) }}
                                {{ form_errors(form.username) }}
                            </div>
                        </div>
                        
                        <!-- Section 4: Password (only for add) -->
                        {% if form.plainPassword is defined %}
                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                {{ form_label(form.plainPassword, form.plainPassword.vars.label, {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                <small class=\"text-muted d-block mb-2\">Minimum 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre</small>
                                <div class=\"input-group\" id=\"show_hide_password\">
                                    {{ form_widget(form.plainPassword, {'attr': {'class': 'form-control border-end-0', 'placeholder': 'Enter Password'}}) }}
                                    <a href=\"javascript:;\" class=\"input-group-text bg-transparent\">
                                        <i class=\"fas fa-eye-slash\"></i>
                                    </a>
                                </div>
                                {{ form_errors(form.plainPassword) }}
                            </div>
                        </div>
                        {% endif %}
                        
                        <!-- Section 4: Role and Status -->
                        <div class=\"row g-4 mb-4\">
                            <div class=\"col-md-6\">
                                {{ form_label(form.roles, 'Rôle', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                {{ form_widget(form.roles, {'attr': {'class': 'form-select'}}) }}
                                {{ form_errors(form.roles) }}
                            </div>
                            
                            <div class=\"col-md-6\">
                                {{ form_label(form.status, 'Statut', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                {{ form_widget(form.status, {'attr': {'class': 'form-select'}}) }}
                                {{ form_errors(form.status) }}
                            </div>
                        </div>
                        
                        <!-- Section 5: Photo -->
                        <div class=\"row mb-4\">
                            <div class=\"col-12\">
                                {{ form_label(form.photoFile, 'Photo de profil', {'label_attr': {'class': 'form-label fw-semibold'}}) }}
                                <small class=\"text-muted d-block mb-2\">JPG/PNG, max 2Mo</small>
                                {{ form_widget(form.photoFile, {'attr': {'class': 'form-control'}}) }}
                                {{ form_errors(form.photoFile) }}
                            </div>
                        </div>
                        
                        <!-- Section 6: Submit -->
                        <div class=\"border-top pt-4 mt-5\">
                            <div class=\"d-grid gap-3 d-md-flex justify-content-md-start\">
                                <button type=\"submit\" class=\"btn btn-primary\">
                                    <i class=\"material-icons-outlined me-2\">save</i>
                                    {% if user is defined %}Enregistrer les modifications{% else %}Créer l'utilisateur{% endif %}
                                </button>
                                <a href=\"{{ path('admin_users') }}\" class=\"btn btn-secondary\">
                                    <i class=\"material-icons-outlined me-2\">cancel</i>
                                    Annuler
                                </a>
                            </div>
                        </div>
                        
                        {{ form_end(form) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper-->

<script>
\$(document).ready(function () {
    // Toggle password show/hide
    \$(\"#show_hide_password a\").on('click', function (event) {
        event.preventDefault();
        const input = \$('#show_hide_password input');
        const icon = \$('#show_hide_password i');
        if (input.attr(\"type\") === \"text\") {
            input.attr('type', 'password');
            icon.removeClass(\"fa-eye\").addClass(\"fa-eye-slash\");
        } else {
            input.attr('type', 'text');
            icon.removeClass(\"fa-eye-slash\").addClass(\"fa-eye\");
        }
    });

    // Validation functions
    function validateEmail(email) {
        const re = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
        return re.test(email);
    }

    function showError(input, message) {
        const \$input = \$(input);
        \$input.addClass('is-invalid');
        \$input.removeClass('shake');
        void \$input[0].offsetWidth; // force reflow
        \$input.addClass('shake');

        if (!\$input.next('.invalid-feedback').length) {
            \$input.after(`<div class=\"invalid-feedback\">\${message}</div>`);
        } else {
            \$input.next('.invalid-feedback').text(message);
        }
    }

    function clearError(input) {
        const \$input = \$(input);
        \$input.removeClass('is-invalid shake');
        \$input.next('.invalid-feedback').remove();
    }

    // Live validation on typing for Email
    \$('#user_form_email').on('input', function () {
        const email = \$(this).val().trim();
        if (email === '') {
            clearError(this);
        } else if (!email.includes('@')) {
            showError(this, \"Missing @ symbol.\");
        } else if (email.indexOf('@') !== email.lastIndexOf('@')) {
            showError(this, \"Only one @ symbol is allowed.\");
        } else if (email.split('@')[1].length < 1) {
            showError(this, \"Missing characters after @.\");
        } else if (email.split('@')[1] && !email.split('@')[1].includes('.')) {
            showError(this, \"Missing domain extension (e.g., .com).\");
        } else if (!validateEmail(email)) {
            showError(this, \"Enter a valid email.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for Password
    \$('#user_form_plainPassword').on('input', function () {
        const password = \$(this).val().trim();
        if (password === '') {
            clearError(this);
        } else if (password.length < 8) {
            showError(this, \"Le mot de passe doit contenir au moins 8 caractères.\");
        } else if (!/(?=.*[a-z])/.test(password)) {
            showError(this, \"Le mot de passe doit contenir au moins une minuscule.\");
        } else if (!/(?=.*[A-Z])/.test(password)) {
            showError(this, \"Le mot de passe doit contenir au moins une majuscule.\");
        } else if (!/(?=.*\\d)/.test(password)) {
            showError(this, \"Le mot de passe doit contenir au moins un chiffre.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for First Name
    \$('#user_form_firstName').on('input', function () {
        const firstName = \$(this).val().trim();
        if (firstName === '') {
            clearError(this);
        } else if (!/^[a-zA-Zàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñç\\s-]+\$/.test(firstName)) {
            showError(this, \"First name can only contain letters and spaces.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for Last Name
    \$('#user_form_lastName').on('input', function () {
        const lastName = \$(this).val().trim();
        if (lastName === '') {
            clearError(this);
        } else if (!/^[a-zA-Zàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñç\\s-]+\$/.test(lastName)) {
            showError(this, \"Last name can only contain letters and spaces.\");
        } else {
            clearError(this);
        }
    });

    // Live validation on typing for Age
    \$('#user_form_age').on('input', function () {
        const age = \$(this).val().trim();
        if (age === '') {
            clearError(this);
        } else if (isNaN(age) || age < 1 || age > 120) {
            showError(this, \"Age must be between 1 and 120.\");
        } else {
            clearError(this);
        }
    });
});
</script>

<style>
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-6px); }
    50% { transform: translateX(6px); }
    75% { transform: translateX(-6px); }
    100% { transform: translateX(0); }
}

.shake {
    animation: shake 0.3s;
}

.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.invalid-feedback {
    display: block !important;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-control {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
}

.form-select {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
}

.input-group-text {
    border: 2px solid #e0e0e0;
    border-left: none;
    background: transparent;
    color: #666;
}

.form-control.border-end-0 {
    border-right: none;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}
</style>
{% endblock page_content %}", "dashboard/user_form.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\dashboard\\user_form.html.twig");
    }
}
