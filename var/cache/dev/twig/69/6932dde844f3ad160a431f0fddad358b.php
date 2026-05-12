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

/* forum/new_discussion.html.twig */
class __TwigTemplate_38b901e69452ec0a1a65b7939102da6b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/new_discussion.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/new_discussion.html.twig"));

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

        yield "New Discussion - Forum - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        
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
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
                        <span data-text-preloader=\"E\" class=\"letters-loading\">E</span>
                        <span data-text-preloader=\"W\" class=\"letters-loading\">W</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class=\"main-header header-style-one\">
        <div class=\"header-lower\">
            <div class=\"auto-container\">
                <div class=\"inner-container\">
                    <div class=\"d-flex justify-content-between align-items-center flex-wrap\">
                        
                        <div class=\"logo-box\">
                            <div class=\"logo\"><a href=\"";
        // line 31
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\"><img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/logo.svg"), "html", null, true);
        yield "\" alt=\"\" title=\"\"></a></div>
                        </div>
                        
                        <div class=\"nav-outer d-flex flex-wrap\">
                            <!-- Main Menu -->
                            <nav class=\"main-menu navbar-expand-md\">
                                <div class=\"navbar-header\">
                                    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                    </button>
                                </div>
                                
                                <div class=\"navbar-collapse collapse clearfix\" id=\"navbarSupportedContent\">
                                    <ul class=\"navigation clearfix\">
                                        <li><a href=\"";
        // line 47
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
                                        <li><a href=\"";
        // line 48
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></li>
                                        <li class=\"current\"><a href=\"#\">New Discussion</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Main Menu End-->
                        <div class=\"outer-box d-flex align-items-center flex-wrap\">
                            <span class=\"welcome-text\">Welcome, ";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 57, $this->source); })()), "user", [], "any", false, false, false, 57), "firstName", [], "any", false, false, false, 57) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 57, $this->source); })()), "user", [], "any", false, false, false, 57), "lastName", [], "any", false, false, false, 57))), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 57, $this->source); })()), "user", [], "any", false, false, false, 57), "email", [], "any", false, false, false, 57)), "html", null, true);
        yield "</span>
                            <a href=\"";
        // line 58
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\" class=\"template-btn btn-style-two\">
                                <span class=\"btn-wrap\">
                                    <span class=\"text-one\">Back to Forum</span>
                                    <span class=\"text-two\">Back to Forum</span>
                                </span>
                            </a>
                            <a href=\"";
        // line 64
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"template-btn btn-style-two\">
                                <span class=\"btn-wrap\">
                                    <span class=\"text-one\">Logout</span>
                                    <span class=\"text-two\">Logout</span>
                                </span>
                            </a>
                        </div>

                        <!-- Mobile Navigation Toggler -->
                        <div class=\"mobile-nav-toggler\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-menu-2\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M4 6l16 0\" /><path d=\"M4 12l16 0\" /><path d=\"M4 18l16 0\" /></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- New Discussion Form -->
    <section class=\"new-discussion-section\" style=\"padding: 120px 0 80px 0;\">
        <div class=\"auto-container\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-8\">
                    <div class=\"form-container\" style=\"background: rgba(255,255,255,0.08); border-radius: 20px; padding: 50px; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 8px 32px rgba(0,0,0,0.1);\">
                        <div class=\"text-center mb-5\">
                            <h2 class=\"text-white mb-3\" style=\"font-size: 32px; font-weight: 700;\">Start a New Discussion</h2>
                            <p class=\"text-white-50\" style=\"font-size: 16px;\">Share your thoughts and engage with the community</p>
                        </div>

                        ";
        // line 93
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 93, $this->source); })()), "flashes", ["success"], "method", false, false, false, 93));
        foreach ($context['_seq'] as $context["_key"] => $context["flash_message"]) {
            // line 94
            yield "                            <div class=\"alert alert-success\" style=\"background: rgba(40, 167, 69, 0.2); border: 1px solid rgba(40, 167, 69, 0.5); color: white;\">
                                ";
            // line 95
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["flash_message"], "html", null, true);
            yield "
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['flash_message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        yield "
                        ";
        // line 99
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 99, $this->source); })()), 'form_start', ["attr" => ["class" => "discussion-form"]]);
        yield "
                            <div class=\"mb-4\">
                                ";
        // line 101
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 101, $this->source); })()), "title", [], "any", false, false, false, 101), 'label', ["label_attr" => ["class" => "form-label text-white mb-3"]]);
        yield "
                                ";
        // line 102
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 102, $this->source); })()), "title", [], "any", false, false, false, 102), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "Enter a clear and descriptive title...", "style" => "background: white; color: #333; border: 1px solid #ddd; padding: 12px 15px; border-radius: 8px;"]]);
        yield "
                                ";
        // line 103
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 103, $this->source); })()), "title", [], "any", false, false, false, 103), 'errors', ["attr" => ["class" => "text-danger"]]);
        yield "
                            </div>

                            <div class=\"mb-4\">
                                ";
        // line 107
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 107, $this->source); })()), "category", [], "any", false, false, false, 107), 'label', ["label_attr" => ["class" => "form-label text-white mb-3"]]);
        yield "
                                ";
        // line 108
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 108, $this->source); })()), "category", [], "any", false, false, false, 108), 'widget', ["attr" => ["class" => "form-control", "style" => "background: white; color: #333; border: 1px solid #ddd; padding: 12px 15px; border-radius: 8px;"]]);
        yield "
                                ";
        // line 109
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 109, $this->source); })()), "category", [], "any", false, false, false, 109), 'errors', ["attr" => ["class" => "text-danger"]]);
        yield "
                            </div>

                            <div class=\"mb-4\">
                                ";
        // line 113
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 113, $this->source); })()), "content", [], "any", false, false, false, 113), 'label', ["label_attr" => ["class" => "form-label text-white mb-3"]]);
        yield "
                                ";
        // line 114
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 114, $this->source); })()), "content", [], "any", false, false, false, 114), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "Write your discussion content here...", "style" => "background: white; color: #333; border: 1px solid #ddd; padding: 15px; border-radius: 8px; min-height: 150px;"]]);
        yield "
                                ";
        // line 115
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 115, $this->source); })()), "content", [], "any", false, false, false, 115), 'errors', ["attr" => ["class" => "text-danger"]]);
        yield "
                            </div>

                            
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <a href=\"";
        // line 120
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\" class=\"btn btn-outline-light\" style=\"border: 1px solid rgba(255,255,255,0.5); color: white; padding: 10px 25px; border-radius: 25px;\">
                                    <i class=\"fa fa-arrow-left\"></i> Cancel
                                </a>
                                <button type=\"submit\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Create Discussion</span>
                                        <span class=\"text-two\">Create Discussion</span>
                                    </span>
                                </button>
                            </div>
                        ";
        // line 130
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 130, $this->source); })()), 'form_end');
        yield "
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Guidelines -->
    <section class=\"guidelines-section\" style=\"padding: 40px 0;\">
        <div class=\"auto-container\">
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"guidelines-box\" style=\"background: rgba(255,255,255,0.05); border-radius: 15px; padding: 30px; border: 1px solid rgba(255,255,255,0.1);\">
                        <h4 class=\"text-white mb-3\"><i class=\"fa fa-lightbulb\"></i> Community Guidelines</h4>
                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <ul class=\"text-white-70\" style=\"line-height: 1.8;\">
                                    <li><i class=\"fa fa-check text-success\"></i> Be respectful and constructive</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Stay on topic</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Use clear and descriptive titles</li>
                                </ul>
                            </div>
                            <div class=\"col-md-6\">
                                <ul class=\"text-white-70\" style=\"line-height: 1.8;\">
                                    <li><i class=\"fa fa-check text-success\"></i> Search before posting</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Provide helpful context</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Engage with responses</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.text-white-70 {
    color: rgba(255,255,255,0.7) !important;
}

.text-white-50 {
    color: rgba(255,255,255,0.5) !important;
}

.form-label {
    font-weight: 600;
    margin-bottom: 8px;
}

.alert-success {
    border-radius: 10px;
    padding: 15px;
}

.form-control:focus {
    background: white !important;
    color: #333 !important;
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
}

.btn-outline-light:hover {
    background: rgba(255,255,255,0.1);
    border-color: white;
}
</style>

<!-- Scripts -->
<script src=\"";
        // line 200
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.js"), "html", null, true);
        yield "\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);
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
        return "forum/new_discussion.html.twig";
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
        return array (  366 => 200,  293 => 130,  280 => 120,  272 => 115,  268 => 114,  264 => 113,  257 => 109,  253 => 108,  249 => 107,  242 => 103,  238 => 102,  234 => 101,  229 => 99,  226 => 98,  217 => 95,  214 => 94,  210 => 93,  178 => 64,  169 => 58,  165 => 57,  153 => 48,  149 => 47,  128 => 31,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}New Discussion - Forum - {{ parent() }}{% endblock %}

{% block body %}
<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
                        <span data-text-preloader=\"E\" class=\"letters-loading\">E</span>
                        <span data-text-preloader=\"W\" class=\"letters-loading\">W</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class=\"main-header header-style-one\">
        <div class=\"header-lower\">
            <div class=\"auto-container\">
                <div class=\"inner-container\">
                    <div class=\"d-flex justify-content-between align-items-center flex-wrap\">
                        
                        <div class=\"logo-box\">
                            <div class=\"logo\"><a href=\"{{ path('app_homepage') }}\"><img src=\"{{ asset('assets_front/images/logo.svg') }}\" alt=\"\" title=\"\"></a></div>
                        </div>
                        
                        <div class=\"nav-outer d-flex flex-wrap\">
                            <!-- Main Menu -->
                            <nav class=\"main-menu navbar-expand-md\">
                                <div class=\"navbar-header\">
                                    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                    </button>
                                </div>
                                
                                <div class=\"navbar-collapse collapse clearfix\" id=\"navbarSupportedContent\">
                                    <ul class=\"navigation clearfix\">
                                        <li><a href=\"{{ path('app_homepage') }}\">Home</a></li>
                                        <li><a href=\"{{ path('forum_index') }}\">Forum</a></li>
                                        <li class=\"current\"><a href=\"#\">New Discussion</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Main Menu End-->
                        <div class=\"outer-box d-flex align-items-center flex-wrap\">
                            <span class=\"welcome-text\">Welcome, {{ (app.user.firstName ~ ' ' ~ app.user.lastName)|trim|default(app.user.email) }}</span>
                            <a href=\"{{ path('forum_index') }}\" class=\"template-btn btn-style-two\">
                                <span class=\"btn-wrap\">
                                    <span class=\"text-one\">Back to Forum</span>
                                    <span class=\"text-two\">Back to Forum</span>
                                </span>
                            </a>
                            <a href=\"{{ path('app_logout') }}\" class=\"template-btn btn-style-two\">
                                <span class=\"btn-wrap\">
                                    <span class=\"text-one\">Logout</span>
                                    <span class=\"text-two\">Logout</span>
                                </span>
                            </a>
                        </div>

                        <!-- Mobile Navigation Toggler -->
                        <div class=\"mobile-nav-toggler\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-menu-2\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M4 6l16 0\" /><path d=\"M4 12l16 0\" /><path d=\"M4 18l16 0\" /></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- New Discussion Form -->
    <section class=\"new-discussion-section\" style=\"padding: 120px 0 80px 0;\">
        <div class=\"auto-container\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-8\">
                    <div class=\"form-container\" style=\"background: rgba(255,255,255,0.08); border-radius: 20px; padding: 50px; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 8px 32px rgba(0,0,0,0.1);\">
                        <div class=\"text-center mb-5\">
                            <h2 class=\"text-white mb-3\" style=\"font-size: 32px; font-weight: 700;\">Start a New Discussion</h2>
                            <p class=\"text-white-50\" style=\"font-size: 16px;\">Share your thoughts and engage with the community</p>
                        </div>

                        {% for flash_message in app.flashes('success') %}
                            <div class=\"alert alert-success\" style=\"background: rgba(40, 167, 69, 0.2); border: 1px solid rgba(40, 167, 69, 0.5); color: white;\">
                                {{ flash_message }}
                            </div>
                        {% endfor %}

                        {{ form_start(form, {'attr': {'class': 'discussion-form'}}) }}
                            <div class=\"mb-4\">
                                {{ form_label(form.title, null, {'label_attr': {'class': 'form-label text-white mb-3'}}) }}
                                {{ form_widget(form.title, {'attr': {'class': 'form-control', 'placeholder': 'Enter a clear and descriptive title...', 'style': 'background: white; color: #333; border: 1px solid #ddd; padding: 12px 15px; border-radius: 8px;'}}) }}
                                {{ form_errors(form.title, {'attr': {'class': 'text-danger'}}) }}
                            </div>

                            <div class=\"mb-4\">
                                {{ form_label(form.category, null, {'label_attr': {'class': 'form-label text-white mb-3'}}) }}
                                {{ form_widget(form.category, {'attr': {'class': 'form-control', 'style': 'background: white; color: #333; border: 1px solid #ddd; padding: 12px 15px; border-radius: 8px;'}}) }}
                                {{ form_errors(form.category, {'attr': {'class': 'text-danger'}}) }}
                            </div>

                            <div class=\"mb-4\">
                                {{ form_label(form.content, null, {'label_attr': {'class': 'form-label text-white mb-3'}}) }}
                                {{ form_widget(form.content, {'attr': {'class': 'form-control', 'placeholder': 'Write your discussion content here...', 'style': 'background: white; color: #333; border: 1px solid #ddd; padding: 15px; border-radius: 8px; min-height: 150px;'}}) }}
                                {{ form_errors(form.content, {'attr': {'class': 'text-danger'}}) }}
                            </div>

                            
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <a href=\"{{ path('forum_index') }}\" class=\"btn btn-outline-light\" style=\"border: 1px solid rgba(255,255,255,0.5); color: white; padding: 10px 25px; border-radius: 25px;\">
                                    <i class=\"fa fa-arrow-left\"></i> Cancel
                                </a>
                                <button type=\"submit\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Create Discussion</span>
                                        <span class=\"text-two\">Create Discussion</span>
                                    </span>
                                </button>
                            </div>
                        {{ form_end(form) }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Guidelines -->
    <section class=\"guidelines-section\" style=\"padding: 40px 0;\">
        <div class=\"auto-container\">
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"guidelines-box\" style=\"background: rgba(255,255,255,0.05); border-radius: 15px; padding: 30px; border: 1px solid rgba(255,255,255,0.1);\">
                        <h4 class=\"text-white mb-3\"><i class=\"fa fa-lightbulb\"></i> Community Guidelines</h4>
                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <ul class=\"text-white-70\" style=\"line-height: 1.8;\">
                                    <li><i class=\"fa fa-check text-success\"></i> Be respectful and constructive</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Stay on topic</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Use clear and descriptive titles</li>
                                </ul>
                            </div>
                            <div class=\"col-md-6\">
                                <ul class=\"text-white-70\" style=\"line-height: 1.8;\">
                                    <li><i class=\"fa fa-check text-success\"></i> Search before posting</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Provide helpful context</li>
                                    <li><i class=\"fa fa-check text-success\"></i> Engage with responses</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.text-white-70 {
    color: rgba(255,255,255,0.7) !important;
}

.text-white-50 {
    color: rgba(255,255,255,0.5) !important;
}

.form-label {
    font-weight: 600;
    margin-bottom: 8px;
}

.alert-success {
    border-radius: 10px;
    padding: 15px;
}

.form-control:focus {
    background: white !important;
    color: #333 !important;
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
}

.btn-outline-light:hover {
    background: rgba(255,255,255,0.1);
    border-color: white;
}
</style>

<!-- Scripts -->
<script src=\"{{ asset('assets_front/js/jquery.js') }}\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);
});
</script>
{% endblock %}
", "forum/new_discussion.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\forum\\new_discussion.html.twig");
    }
}
