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

/* forum/edit_message.html.twig */
class __TwigTemplate_12a47943395582d4061d40ab54c6eee4 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/edit_message.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/edit_message.html.twig"));

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

        yield "Edit Message - Forum - ";
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
                                        <li class=\"current\"><a href=\"#\">Edit Message</a></li>
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
                            <h2 class=\"text-white mb-3\">Edit Message</h2>
                            <p class=\"text-white-50\">Update your message content</p>
                        </div>

                        <!-- Discussion Context -->
                        <div class=\"discussion-context mb-4 p-3\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);\">
                            <h5 class=\"text-white mb-2\">Discussion: ";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 76, $this->source); })()), "discussion", [], "any", false, false, false, 76), "title", [], "any", false, false, false, 76), "html", null, true);
        yield "</h5>
                            <p class=\"text-white-50 small mb-0\">
                                <i class=\"fa fa-comments me-2\"></i>
                                Originally posted on ";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 79, $this->source); })()), "createdAt", [], "any", false, false, false, 79), "F j, Y, g:i a"), "html", null, true);
        yield "
                            </p>
                        </div>

                        <!-- Edit Form -->
                        ";
        // line 84
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 84, $this->source); })()), 'form_start', ["attr" => ["class" => "forum-form"]]);
        yield "
                            
                            <!-- Content Field -->
                            <div class=\"form-group mb-4\">
                                ";
        // line 88
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 88, $this->source); })()), "content", [], "any", false, false, false, 88), 'label', ["label_attr" => ["class" => "text-white mb-2"]]);
        yield "
                                ";
        // line 89
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 89, $this->source); })()), "content", [], "any", false, false, false, 89), 'widget', ["attr" => ["class" => "form-control", "style" => "background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 15px; border-radius: 8px; min-height: 150px;"]]);
        yield "
                                ";
        // line 90
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 90, $this->source); })()), "content", [], "any", false, false, false, 90), "vars", [], "any", false, false, false, 90), "errors", [], "any", false, false, false, 90)) > 0)) {
            // line 91
            yield "                                    <div class=\"text-danger mt-2\">
                                        ";
            // line 92
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 92, $this->source); })()), "content", [], "any", false, false, false, 92), "vars", [], "any", false, false, false, 92), "errors", [], "any", false, false, false, 92));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 93
                yield "                                            <small>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 93), "html", null, true);
                yield "</small>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 95
            yield "                                    </div>
                                ";
        }
        // line 97
        yield "                            </div>

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
        // line 108
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 108, $this->source); })()), "discussion", [], "any", false, false, false, 108), "id", [], "any", false, false, false, 108)]), "html", null, true);
        yield "\" class=\"template-btn btn-style-two\" style=\"background: rgba(255,255,255,0.2); color: white; padding: 12px 30px; border: 1px solid rgba(255,255,255,0.3); border-radius: 25px; text-decoration: none; display: inline-block;\">
                                        Cancel
                                    </a>
                                </div>
                            </div>

                        ";
        // line 114
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 114, $this->source); })()), 'form_end');
        yield "

                        <!-- Community Guidelines -->
                        <div class=\"community-guidelines mt-5 p-3\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);\">
                            <h5 class=\"text-white mb-2\">Community Guidelines</h5>
                            <ul class=\"text-white-50 small mb-0\" style=\"list-style: none; padding-left: 0;\">
                                <li><i class=\"fa fa-check-circle me-2\"></i>Be respectful and constructive</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Keep content relevant to the discussion</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Provide helpful and informative responses</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Avoid spam and off-topic content</li>
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
        return "forum/edit_message.html.twig";
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
        return array (  257 => 114,  248 => 108,  235 => 97,  231 => 95,  222 => 93,  218 => 92,  215 => 91,  213 => 90,  209 => 89,  205 => 88,  198 => 84,  190 => 79,  184 => 76,  154 => 49,  150 => 48,  129 => 32,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Message - Forum - {{ parent() }}{% endblock %}

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
                                        <li class=\"current\"><a href=\"#\">Edit Message</a></li>
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
                            <h2 class=\"text-white mb-3\">Edit Message</h2>
                            <p class=\"text-white-50\">Update your message content</p>
                        </div>

                        <!-- Discussion Context -->
                        <div class=\"discussion-context mb-4 p-3\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);\">
                            <h5 class=\"text-white mb-2\">Discussion: {{ message.discussion.title }}</h5>
                            <p class=\"text-white-50 small mb-0\">
                                <i class=\"fa fa-comments me-2\"></i>
                                Originally posted on {{ message.createdAt|date('F j, Y, g:i a') }}
                            </p>
                        </div>

                        <!-- Edit Form -->
                        {{ form_start(form, {'attr': {'class': 'forum-form'}}) }}
                            
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

                            <!-- Form Actions -->
                            <div class=\"form-group text-center mt-5\">
                                <div class=\"d-inline-flex align-items-center gap-3\">
                                    <button type=\"submit\" class=\"template-btn btn-style-one\" style=\"background: #667eea; color: white; padding: 12px 30px; border: none; border-radius: 25px;\">
                                        <span class=\"btn-wrap\">
                                            <span class=\"text-one\">Update</span>
                                            <span class=\"text-two\">Update</span>
                                        </span>
                                    </button>
                                    <a href=\"{{ path('forum_discussion', {'id': message.discussion.id}) }}\" class=\"template-btn btn-style-two\" style=\"background: rgba(255,255,255,0.2); color: white; padding: 12px 30px; border: 1px solid rgba(255,255,255,0.3); border-radius: 25px; text-decoration: none; display: inline-block;\">
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
                                <li><i class=\"fa fa-check-circle me-2\"></i>Keep content relevant to the discussion</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Provide helpful and informative responses</li>
                                <li><i class=\"fa fa-check-circle me-2\"></i>Avoid spam and off-topic content</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
{% endblock %}
", "forum/edit_message.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\forum\\edit_message.html.twig");
    }
}
