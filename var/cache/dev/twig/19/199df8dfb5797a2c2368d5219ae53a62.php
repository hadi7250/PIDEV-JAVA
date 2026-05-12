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

/* forum/discussion_list.html.twig */
class __TwigTemplate_6e20239aa2eb31adeb56b36b2cd7c04e extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/discussion_list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/discussion_list.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 3, $this->source); })()), "name", [], "any", false, false, false, 3), "html", null, true);
        yield " - Forum - ";
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
                        <span data-text-preloader=\"L\" class=\"letters-loading\">L</span>
                        <span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
                        <span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
                        <span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
                        <span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
                        <span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
                        <span data-text-preloader=\"G\" class=\"letters-loading\">G</span>
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
        // line 35
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
        // line 51
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
                                        <li><a href=\"";
        // line 52
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></li>
                                        <li class=\"current\"><a href=\"#\">";
        // line 53
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 53, $this->source); })()), "name", [], "any", false, false, false, 53), "html", null, true);
        yield "</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Main Menu End-->
                        <div class=\"outer-box d-flex align-items-center flex-wrap\">
                            ";
        // line 61
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "user", [], "any", false, false, false, 61)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 62
            yield "                                <span class=\"welcome-text\">Welcome, ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 62, $this->source); })()), "user", [], "any", false, false, false, 62), "firstName", [], "any", false, false, false, 62) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 62, $this->source); })()), "user", [], "any", false, false, false, 62), "lastName", [], "any", false, false, false, 62))), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 62, $this->source); })()), "user", [], "any", false, false, false, 62), "email", [], "any", false, false, false, 62)), "html", null, true);
            yield "</span>
                                <a href=\"";
            // line 63
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_new_discussion");
            yield "\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">New Discussion</span>
                                        <span class=\"text-two\">New Discussion</span>
                                    </span>
                                </a>
                                <a href=\"";
            // line 69
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Logout</span>
                                        <span class=\"text-two\">Logout</span>
                                    </span>
                                </a>
                            ";
        } else {
            // line 76
            yield "                                <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Login</span>
                                        <span class=\"text-two\">Login</span>
                                    </span>
                                </a>
                                <a href=\"";
            // line 82
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Join now</span>
                                        <span class=\"text-two\">Join now</span>
                                    </span>
                                </a>
                            ";
        }
        // line 89
        yield "                        </div>

                        <!-- Mobile Navigation Toggler -->
                        <div class=\"mobile-nav-toggler\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-menu-2\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M4 6l16 0\" /><path d=\"M4 12l16 0\" /><path d=\"M4 18l16 0\" /></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Category Header -->
    <section class=\"category-header\" style=\"padding: 120px 0 80px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);\">
        <div class=\"auto-container\">
            <div class=\"text-center\">
                <h1 class=\"text-white mb-4\">";
        // line 105
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 105, $this->source); })()), "name", [], "any", false, false, false, 105), "html", null, true);
        yield "</h1>
                <p class=\"text-white-50 mb-4\">";
        // line 106
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 106, $this->source); })()), "description", [], "any", false, false, false, 106), "html", null, true);
        yield "</p>
                <nav aria-label=\"breadcrumb\">
                    <ol class=\"breadcrumb justify-content-center\">
                        <li class=\"breadcrumb-item\"><a href=\"";
        // line 109
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\" style=\"color: rgba(255,255,255,0.8);\">Forum</a></li>
                        <li class=\"breadcrumb-item active text-white\">";
        // line 110
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 110, $this->source); })()), "name", [], "any", false, false, false, 110), "html", null, true);
        yield "</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Discussions List -->
    <section class=\"discussions-section\" style=\"padding: 80px 0 60px 0;\">
        <div class=\"auto-container\">
            <div class=\"d-flex justify-content-between align-items-center mb-5\">
                <h2 class=\"text-white\">Discussions (";
        // line 121
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["discussions"]) || array_key_exists("discussions", $context) ? $context["discussions"] : (function () { throw new RuntimeError('Variable "discussions" does not exist.', 121, $this->source); })())), "html", null, true);
        yield ")</h2>
                ";
        // line 122
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 122, $this->source); })()), "user", [], "any", false, false, false, 122)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 123
            yield "                    <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_new_discussion");
            yield "\" class=\"template-btn btn-style-one\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Start New Discussion</span>
                            <span class=\"text-two\">Start New Discussion</span>
                        </span>
                    </a>
                ";
        }
        // line 130
        yield "            </div>

            ";
        // line 132
        if ((($tmp = (isset($context["discussions"]) || array_key_exists("discussions", $context) ? $context["discussions"] : (function () { throw new RuntimeError('Variable "discussions" does not exist.', 132, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 133
            yield "                <div class=\"discussions-list\">
                    ";
            // line 134
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["discussions"]) || array_key_exists("discussions", $context) ? $context["discussions"] : (function () { throw new RuntimeError('Variable "discussions" does not exist.', 134, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["discussion"]) {
                // line 135
                yield "                        <div class=\"discussion-card\" style=\"background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 25px; margin-bottom: 20px; transition: all 0.3s ease;\">
                            <div class=\"row align-items-center\">
                                <div class=\"col-lg-8\">
                                    <h4 class=\"discussion-title mb-2\">
                                        <a href=\"";
                // line 139
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "id", [], "any", false, false, false, 139)]), "html", null, true);
                yield "\" style=\"color: white; text-decoration: none; font-size: 1.3rem;\">
                                            ";
                // line 140
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 140), "html", null, true);
                yield "
                                        </a>
                                    </h4>
                                    <p class=\"discussion-preview mb-3\" style=\"color: rgba(255,255,255,0.7);\">
                                        ";
                // line 144
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "content", [], "any", false, false, false, 144), 0, 150), "html", null, true);
                yield "...
                                    </p>
                                    <div class=\"discussion-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 14px;\">
                                        <span><i class=\"fa fa-user\"></i> ";
                // line 147
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "authorName", [], "any", false, false, false, 147), "html", null, true);
                yield "</span>
                                        <span class=\"ms-3\"><i class=\"fa fa-clock\"></i> ";
                // line 148
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "createdAt", [], "any", false, false, false, 148), "M d, Y H:i"), "html", null, true);
                yield "</span>
                                        ";
                // line 149
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "updatedAt", [], "any", false, false, false, 149) > CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "createdAt", [], "any", false, false, false, 149))) {
                    // line 150
                    yield "                                            <span class=\"ms-3\"><i class=\"fa fa-edit\"></i> Updated ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "updatedAt", [], "any", false, false, false, 150), "M d, Y H:i"), "html", null, true);
                    yield "</span>
                                        ";
                }
                // line 152
                yield "                                    </div>
                                </div>
                                <div class=\"col-lg-4 text-right\">
                                    <div class=\"discussion-stats\">
                                        <div class=\"stat-item mb-2\">
                                            <span class=\"stat-number\" style=\"color: #667eea; font-size: 1.5rem; font-weight: bold;\">";
                // line 157
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "messageCount", [], "any", true, true, false, 157)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "messageCount", [], "any", false, false, false, 157), 0)) : (0)), "html", null, true);
                yield "</span>
                                            <div class=\"stat-label\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">MESSAGES</div>
                                        </div>
                                        <a href=\"";
                // line 160
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "id", [], "any", false, false, false, 160)]), "html", null, true);
                yield "\" class=\"btn btn-sm\" style=\"background: #667eea; color: white; border: none; padding: 8px 20px; border-radius: 25px;\">
                                            View Discussion
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['discussion'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 168
            yield "                </div>
            ";
        } else {
            // line 170
            yield "                <div class=\"empty-state text-center\" style=\"padding: 60px 0;\">
                    <i class=\"fa fa-comments fa-5x mb-4\" style=\"color: rgba(255,255,255,0.3);\"></i>
                    <h3 class=\"text-white mb-3\">No discussions yet</h3>
                    <p class=\"text-white-50 mb-4\">Be the first to start a discussion in this category!</p>
                    ";
            // line 174
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 174, $this->source); })()), "user", [], "any", false, false, false, 174)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 175
                yield "                        <a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_new_discussion");
                yield "\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Start First Discussion</span>
                                <span class=\"text-two\">Start First Discussion</span>
                            </span>
                        </a>
                    ";
            } else {
                // line 182
                yield "                        <a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
                yield "\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Login to Start Discussion</span>
                                <span class=\"text-two\">Login to Start Discussion</span>
                            </span>
                        </a>
                    ";
            }
            // line 189
            yield "                </div>
            ";
        }
        // line 191
        yield "        </div>
    </section>
</div>

<style>
.discussion-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    background: rgba(255,255,255,0.08) !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: \">\";
    color: rgba(255,255,255,0.6);
}

.stat-item {
    display: inline-block;
    text-align: center;
    min-width: 80px;
}

/* Category Layout Improvements */
.category-header {
    position: relative;
    overflow: hidden;
}

.category-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"rgba(255,255,255,0.05)\" stroke-width=\"0.5\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>');
    pointer-events: none;
}

.category-header h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.category-header p {
    font-size: 18px;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.discussions-section {
    min-height: calc(100vh - 400px);
}

.breadcrumb {
    background: rgba(255,255,255,0.1);
    border-radius: 30px;
    padding: 10px 20px;
    display: inline-block;
    position: relative;
    z-index: 1;
}

.breadcrumb-item {
    font-size: 14px;
}

.discussion-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.discussion-card:hover {
    background: rgba(255,255,255,0.1) !important;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
}

</style>

<!-- Scripts -->
<script src=\"";
        // line 282
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
        return "forum/discussion_list.html.twig";
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
        return array (  492 => 282,  399 => 191,  395 => 189,  384 => 182,  373 => 175,  371 => 174,  365 => 170,  361 => 168,  347 => 160,  341 => 157,  334 => 152,  328 => 150,  326 => 149,  322 => 148,  318 => 147,  312 => 144,  305 => 140,  301 => 139,  295 => 135,  291 => 134,  288 => 133,  286 => 132,  282 => 130,  271 => 123,  269 => 122,  265 => 121,  251 => 110,  247 => 109,  241 => 106,  237 => 105,  219 => 89,  209 => 82,  199 => 76,  189 => 69,  180 => 63,  175 => 62,  173 => 61,  162 => 53,  158 => 52,  154 => 51,  133 => 35,  102 => 6,  89 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ category.name }} - Forum - {{ parent() }}{% endblock %}

{% block body %}
<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"L\" class=\"letters-loading\">L</span>
                        <span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
                        <span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
                        <span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
                        <span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
                        <span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
                        <span data-text-preloader=\"G\" class=\"letters-loading\">G</span>
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
                                        <li class=\"current\"><a href=\"#\">{{ category.name }}</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Main Menu End-->
                        <div class=\"outer-box d-flex align-items-center flex-wrap\">
                            {% if app.user %}
                                <span class=\"welcome-text\">Welcome, {{ (app.user.firstName ~ ' ' ~ app.user.lastName)|trim|default(app.user.email) }}</span>
                                <a href=\"{{ path('forum_new_discussion') }}\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">New Discussion</span>
                                        <span class=\"text-two\">New Discussion</span>
                                    </span>
                                </a>
                                <a href=\"{{ path('app_logout') }}\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Logout</span>
                                        <span class=\"text-two\">Logout</span>
                                    </span>
                                </a>
                            {% else %}
                                <a href=\"{{ path('app_login') }}\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Login</span>
                                        <span class=\"text-two\">Login</span>
                                    </span>
                                </a>
                                <a href=\"{{ path('app_register') }}\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Join now</span>
                                        <span class=\"text-two\">Join now</span>
                                    </span>
                                </a>
                            {% endif %}
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

    <!-- Category Header -->
    <section class=\"category-header\" style=\"padding: 120px 0 80px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);\">
        <div class=\"auto-container\">
            <div class=\"text-center\">
                <h1 class=\"text-white mb-4\">{{ category.name }}</h1>
                <p class=\"text-white-50 mb-4\">{{ category.description }}</p>
                <nav aria-label=\"breadcrumb\">
                    <ol class=\"breadcrumb justify-content-center\">
                        <li class=\"breadcrumb-item\"><a href=\"{{ path('forum_index') }}\" style=\"color: rgba(255,255,255,0.8);\">Forum</a></li>
                        <li class=\"breadcrumb-item active text-white\">{{ category.name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Discussions List -->
    <section class=\"discussions-section\" style=\"padding: 80px 0 60px 0;\">
        <div class=\"auto-container\">
            <div class=\"d-flex justify-content-between align-items-center mb-5\">
                <h2 class=\"text-white\">Discussions ({{ discussions|length }})</h2>
                {% if app.user %}
                    <a href=\"{{ path('forum_new_discussion') }}\" class=\"template-btn btn-style-one\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Start New Discussion</span>
                            <span class=\"text-two\">Start New Discussion</span>
                        </span>
                    </a>
                {% endif %}
            </div>

            {% if discussions %}
                <div class=\"discussions-list\">
                    {% for discussion in discussions %}
                        <div class=\"discussion-card\" style=\"background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 25px; margin-bottom: 20px; transition: all 0.3s ease;\">
                            <div class=\"row align-items-center\">
                                <div class=\"col-lg-8\">
                                    <h4 class=\"discussion-title mb-2\">
                                        <a href=\"{{ path('forum_discussion', {'id': discussion.id}) }}\" style=\"color: white; text-decoration: none; font-size: 1.3rem;\">
                                            {{ discussion.title }}
                                        </a>
                                    </h4>
                                    <p class=\"discussion-preview mb-3\" style=\"color: rgba(255,255,255,0.7);\">
                                        {{ discussion.content|slice(0, 150) }}...
                                    </p>
                                    <div class=\"discussion-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 14px;\">
                                        <span><i class=\"fa fa-user\"></i> {{ discussion.authorName }}</span>
                                        <span class=\"ms-3\"><i class=\"fa fa-clock\"></i> {{ discussion.createdAt|date('M d, Y H:i') }}</span>
                                        {% if discussion.updatedAt > discussion.createdAt %}
                                            <span class=\"ms-3\"><i class=\"fa fa-edit\"></i> Updated {{ discussion.updatedAt|date('M d, Y H:i') }}</span>
                                        {% endif %}
                                    </div>
                                </div>
                                <div class=\"col-lg-4 text-right\">
                                    <div class=\"discussion-stats\">
                                        <div class=\"stat-item mb-2\">
                                            <span class=\"stat-number\" style=\"color: #667eea; font-size: 1.5rem; font-weight: bold;\">{{ discussion.messageCount|default(0) }}</span>
                                            <div class=\"stat-label\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">MESSAGES</div>
                                        </div>
                                        <a href=\"{{ path('forum_discussion', {'id': discussion.id}) }}\" class=\"btn btn-sm\" style=\"background: #667eea; color: white; border: none; padding: 8px 20px; border-radius: 25px;\">
                                            View Discussion
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {% endfor %}
                </div>
            {% else %}
                <div class=\"empty-state text-center\" style=\"padding: 60px 0;\">
                    <i class=\"fa fa-comments fa-5x mb-4\" style=\"color: rgba(255,255,255,0.3);\"></i>
                    <h3 class=\"text-white mb-3\">No discussions yet</h3>
                    <p class=\"text-white-50 mb-4\">Be the first to start a discussion in this category!</p>
                    {% if app.user %}
                        <a href=\"{{ path('forum_new_discussion') }}\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Start First Discussion</span>
                                <span class=\"text-two\">Start First Discussion</span>
                            </span>
                        </a>
                    {% else %}
                        <a href=\"{{ path('app_login') }}\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Login to Start Discussion</span>
                                <span class=\"text-two\">Login to Start Discussion</span>
                            </span>
                        </a>
                    {% endif %}
                </div>
            {% endif %}
        </div>
    </section>
</div>

<style>
.discussion-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    background: rgba(255,255,255,0.08) !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: \">\";
    color: rgba(255,255,255,0.6);
}

.stat-item {
    display: inline-block;
    text-align: center;
    min-width: 80px;
}

/* Category Layout Improvements */
.category-header {
    position: relative;
    overflow: hidden;
}

.category-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"rgba(255,255,255,0.05)\" stroke-width=\"0.5\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>');
    pointer-events: none;
}

.category-header h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.category-header p {
    font-size: 18px;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.discussions-section {
    min-height: calc(100vh - 400px);
}

.breadcrumb {
    background: rgba(255,255,255,0.1);
    border-radius: 30px;
    padding: 10px 20px;
    display: inline-block;
    position: relative;
    z-index: 1;
}

.breadcrumb-item {
    font-size: 14px;
}

.discussion-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.discussion-card:hover {
    background: rgba(255,255,255,0.1) !important;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
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
", "forum/discussion_list.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\forum\\discussion_list.html.twig");
    }
}
