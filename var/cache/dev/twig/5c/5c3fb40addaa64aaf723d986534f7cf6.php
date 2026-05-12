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

/* forum/edit_discussion.html.twig */
class __TwigTemplate_9f8816c774eb400325ec1a606344a530 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/edit_discussion.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/edit_discussion.html.twig"));

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

        yield "Edit Discussion - Forum - ";
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
                        <span data-text-preloader=\"E\" class=\"letters-loading\">E</span>
                        <span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
                        <span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
                        <span data-text-preloader=\"T\" class=\"letters-loading\">T</span>
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
        // line 32
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
        // line 48
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
                                        <li><a href=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></li>
                                        <li class=\"current\"><a href=\"#\">Edit Discussion</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <section class=\"forum-section\" style=\"padding: 120px 0 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);\">
        <div class=\"container\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-8\">
                    <div class=\"forum-card\" style=\"background: rgba(255,255,255,0.1); border-radius: 20px; padding: 40px; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(10px);\">
                        
                        <!-- Header -->
                        <div class=\"text-center mb-5\">
                            <h2 class=\"text-white mb-3\">Edit Discussion</h2>
                            <p class=\"text-white-50\">Update your discussion details</p>
                        </div>

                        <!-- Edit Form -->
                        ";
        // line 75
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), 'form_start', ["attr" => ["class" => "forum-form"]]);
        yield "
                            
                            <!-- Title Field -->
                            <div class=\"form-group mb-4\">
                                ";
        // line 79
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 79, $this->source); })()), "title", [], "any", false, false, false, 79), 'label', ["label_attr" => ["class" => "text-white mb-2"]]);
        yield "
                                ";
        // line 80
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 80, $this->source); })()), "title", [], "any", false, false, false, 80), 'widget', ["attr" => ["class" => "form-control", "style" => "background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 15px; border-radius: 8px;"]]);
        yield "
                                ";
        // line 81
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 81, $this->source); })()), "title", [], "any", false, false, false, 81), "vars", [], "any", false, false, false, 81), "errors", [], "any", false, false, false, 81)) > 0)) {
            // line 82
            yield "                                    <div class=\"text-danger mt-2\">
                                        ";
            // line 83
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 83, $this->source); })()), "title", [], "any", false, false, false, 83), "vars", [], "any", false, false, false, 83), "errors", [], "any", false, false, false, 83));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 84
                yield "                                            <small>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 84), "html", null, true);
                yield "</small>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 86
            yield "                                    </div>
                                ";
        }
        // line 88
        yield "                            </div>

                            <!-- Category Field -->
                            <div class=\"form-group mb-4\">
                                ";
        // line 92
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 92, $this->source); })()), "category", [], "any", false, false, false, 92), 'label', ["label_attr" => ["class" => "text-white mb-2"]]);
        yield "
                                ";
        // line 93
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 93, $this->source); })()), "category", [], "any", false, false, false, 93), 'widget', ["attr" => ["class" => "form-control", "style" => "background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 15px; border-radius: 8px;"]]);
        yield "
                                ";
        // line 94
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 94, $this->source); })()), "category", [], "any", false, false, false, 94), "vars", [], "any", false, false, false, 94), "errors", [], "any", false, false, false, 94)) > 0)) {
            // line 95
            yield "                                    <div class=\"text-danger mt-2\">
                                        ";
            // line 96
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 96, $this->source); })()), "category", [], "any", false, false, false, 96), "vars", [], "any", false, false, false, 96), "errors", [], "any", false, false, false, 96));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 97
                yield "                                            <small>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 97), "html", null, true);
                yield "</small>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            yield "                                    </div>
                                ";
        }
        // line 101
        yield "                            </div>

                            <!-- Content Field -->
                            <div class=\"form-group mb-4\">
                                ";
        // line 105
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 105, $this->source); })()), "content", [], "any", false, false, false, 105), 'label', ["label_attr" => ["class" => "text-white mb-2"]]);
        yield "
                                ";
        // line 106
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 106, $this->source); })()), "content", [], "any", false, false, false, 106), 'widget', ["attr" => ["class" => "form-control", "style" => "background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 15px; border-radius: 8px; min-height: 150px;"]]);
        yield "
                                ";
        // line 107
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 107, $this->source); })()), "content", [], "any", false, false, false, 107), "vars", [], "any", false, false, false, 107), "errors", [], "any", false, false, false, 107)) > 0)) {
            // line 108
            yield "                                    <div class=\"text-danger mt-2\">
                                        ";
            // line 109
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 109, $this->source); })()), "content", [], "any", false, false, false, 109), "vars", [], "any", false, false, false, 109), "errors", [], "any", false, false, false, 109));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 110
                yield "                                            <small>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 110), "html", null, true);
                yield "</small>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 112
            yield "                                    </div>
                                ";
        }
        // line 114
        yield "                            </div>

                            </div>

                            <!-- Form Actions -->
                            <div class=\"form-group text-center mt-5\">
                                <div class=\"d-inline-flex align-items-center gap-3\">
                                    <button type=\"submit\" class=\"template-btn btn-style-one\" style=\"background: #667eea; color: white; padding: 12px 30px; border: none; border-radius: 25px;\">
                                        <span class=\"btn-wrap\">
                                            <span class=\"text-one\">Update</span>
                                            <span class=\"text-two\">Update</span>
                                        </span>
                                    </button>
                                    <a href=\"";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 127, $this->source); })()), "id", [], "any", false, false, false, 127)]), "html", null, true);
        yield "\" class=\"template-btn btn-style-two\" style=\"background: rgba(255,255,255,0.2); color: white; padding: 12px 30px; border: 1px solid rgba(255,255,255,0.3); border-radius: 25px; text-decoration: none; display: inline-block;\">
                                        Cancel
                                    </a>
                                </div>
                            </div>

                        ";
        // line 133
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 133, $this->source); })()), 'form_end');
        yield "

                        <!-- Community Guidelines -->
                        <div class=\"community-guidelines mt-5 p-3\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);\">
                            <h5 class=\"text-white mb-2\">Community Guidelines</h5>
                            <ul class=\"text-white-50 small mb-0\" style=\"list-style: none; padding-left: 0;\">
                                <li><i class=\"fa fa-check-circle me-2\"></i>Be respectful and constructive</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Keep content relevant to the category</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Use clear and descriptive titles</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Provide sufficient details in your content</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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
        return "forum/edit_discussion.html.twig";
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
        return array (  316 => 133,  307 => 127,  292 => 114,  288 => 112,  279 => 110,  275 => 109,  272 => 108,  270 => 107,  266 => 106,  262 => 105,  256 => 101,  252 => 99,  243 => 97,  239 => 96,  236 => 95,  234 => 94,  230 => 93,  226 => 92,  220 => 88,  216 => 86,  207 => 84,  203 => 83,  200 => 82,  198 => 81,  194 => 80,  190 => 79,  183 => 75,  154 => 49,  150 => 48,  129 => 32,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Discussion - Forum - {{ parent() }}{% endblock %}

{% block body %}
<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"E\" class=\"letters-loading\">E</span>
                        <span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
                        <span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
                        <span data-text-preloader=\"T\" class=\"letters-loading\">T</span>
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
                                        <li class=\"current\"><a href=\"#\">Edit Discussion</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <section class=\"forum-section\" style=\"padding: 120px 0 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);\">
        <div class=\"container\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-8\">
                    <div class=\"forum-card\" style=\"background: rgba(255,255,255,0.1); border-radius: 20px; padding: 40px; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(10px);\">
                        
                        <!-- Header -->
                        <div class=\"text-center mb-5\">
                            <h2 class=\"text-white mb-3\">Edit Discussion</h2>
                            <p class=\"text-white-50\">Update your discussion details</p>
                        </div>

                        <!-- Edit Form -->
                        {{ form_start(form, {'attr': {'class': 'forum-form'}}) }}
                            
                            <!-- Title Field -->
                            <div class=\"form-group mb-4\">
                                {{ form_label(form.title, null, {'label_attr': {'class': 'text-white mb-2'}}) }}
                                {{ form_widget(form.title, {'attr': {'class': 'form-control', 'style': 'background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 15px; border-radius: 8px;'}}) }}
                                {% if form.title.vars.errors|length > 0 %}
                                    <div class=\"text-danger mt-2\">
                                        {% for error in form.title.vars.errors %}
                                            <small>{{ error.message }}</small>
                                        {% endfor %}
                                    </div>
                                {% endif %}
                            </div>

                            <!-- Category Field -->
                            <div class=\"form-group mb-4\">
                                {{ form_label(form.category, null, {'label_attr': {'class': 'text-white mb-2'}}) }}
                                {{ form_widget(form.category, {'attr': {'class': 'form-control', 'style': 'background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 15px; border-radius: 8px;'}}) }}
                                {% if form.category.vars.errors|length > 0 %}
                                    <div class=\"text-danger mt-2\">
                                        {% for error in form.category.vars.errors %}
                                            <small>{{ error.message }}</small>
                                        {% endfor %}
                                    </div>
                                {% endif %}
                            </div>

                            <!-- Content Field -->
                            <div class=\"form-group mb-4\">
                                {{ form_label(form.content, null, {'label_attr': {'class': 'text-white mb-2'}}) }}
                                {{ form_widget(form.content, {'attr': {'class': 'form-control', 'style': 'background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 15px; border-radius: 8px; min-height: 150px;'}}) }}
                                {% if form.content.vars.errors|length > 0 %}
                                    <div class=\"text-danger mt-2\">
                                        {% for error in form.content.vars.errors %}
                                            <small>{{ error.message }}</small>
                                        {% endfor %}
                                    </div>
                                {% endif %}
                            </div>

                            </div>

                            <!-- Form Actions -->
                            <div class=\"form-group text-center mt-5\">
                                <div class=\"d-inline-flex align-items-center gap-3\">
                                    <button type=\"submit\" class=\"template-btn btn-style-one\" style=\"background: #667eea; color: white; padding: 12px 30px; border: none; border-radius: 25px;\">
                                        <span class=\"btn-wrap\">
                                            <span class=\"text-one\">Update</span>
                                            <span class=\"text-two\">Update</span>
                                        </span>
                                    </button>
                                    <a href=\"{{ path('forum_discussion', {'id': discussion.id}) }}\" class=\"template-btn btn-style-two\" style=\"background: rgba(255,255,255,0.2); color: white; padding: 12px 30px; border: 1px solid rgba(255,255,255,0.3); border-radius: 25px; text-decoration: none; display: inline-block;\">
                                        Cancel
                                    </a>
                                </div>
                            </div>

                        {{ form_end(form) }}

                        <!-- Community Guidelines -->
                        <div class=\"community-guidelines mt-5 p-3\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);\">
                            <h5 class=\"text-white mb-2\">Community Guidelines</h5>
                            <ul class=\"text-white-50 small mb-0\" style=\"list-style: none; padding-left: 0;\">
                                <li><i class=\"fa fa-check-circle me-2\"></i>Be respectful and constructive</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Keep content relevant to the category</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Use clear and descriptive titles</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Provide sufficient details in your content</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
{% endblock %}
", "forum/edit_discussion.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\forum\\edit_discussion.html.twig");
    }
}
