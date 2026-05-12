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

/* forum/search_results.html.twig */
class __TwigTemplate_f7e7e2395428a49ae920ba89c53baeca extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/search_results.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/search_results.html.twig"));

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

        yield "Search Results for \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 3, $this->source); })()), "html", null, true);
        yield "\" - Forum - ";
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
                        <span data-text-preloader=\"S\" class=\"letters-loading\">S</span>
                        <span data-text-preloader=\"E\" class=\"letters-loading\">E</span>
                        <span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
                        <span data-text-preloader=\"R\" class=\"letters-loading\">R</span>
                        <span data-text-preloader=\"C\" class=\"letters-loading\">C</span>
                        <span data-text-preloader=\"H\" class=\"letters-loading\">H</span>
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
        // line 34
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
        // line 50
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
                                        <li><a href=\"";
        // line 51
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></li>
                                        <li class=\"current\"><a href=\"#\">Search Results</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Main Menu End-->
                        <div class=\"outer-box d-flex align-items-center flex-wrap\">
                            ";
        // line 60
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 60, $this->source); })()), "user", [], "any", false, false, false, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 61
            yield "                                <span class=\"welcome-text\">Welcome, ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "user", [], "any", false, false, false, 61), "firstName", [], "any", false, false, false, 61) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "user", [], "any", false, false, false, 61), "lastName", [], "any", false, false, false, 61))), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "user", [], "any", false, false, false, 61), "email", [], "any", false, false, false, 61)), "html", null, true);
            yield "</span>
                                <a href=\"";
            // line 62
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_new_discussion");
            yield "\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">New Discussion</span>
                                        <span class=\"text-two\">New Discussion</span>
                                    </span>
                                </a>
                                <a href=\"";
            // line 68
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Logout</span>
                                        <span class=\"text-two\">Logout</span>
                                    </span>
                                </a>
                            ";
        } else {
            // line 75
            yield "                                <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Login</span>
                                        <span class=\"text-two\">Login</span>
                                    </span>
                                </a>
                                <a href=\"";
            // line 81
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Join now</span>
                                        <span class=\"text-two\">Join now</span>
                                    </span>
                                </a>
                            ";
        }
        // line 88
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

    <!-- Search Results -->
    <section class=\"search-results-section\" style=\"padding: 60px 0;\">
        <div class=\"auto-container\">
            <!-- Search Header -->
            <div class=\"search-header text-center mb-5\">
                <h2 class=\"text-white mb-3\">Search Results</h2>
                <p class=\"text-white-50\">
                    Found ";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["discussions"]) || array_key_exists("discussions", $context) ? $context["discussions"] : (function () { throw new RuntimeError('Variable "discussions" does not exist.', 107, $this->source); })())), "html", null, true);
        yield " result";
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["discussions"]) || array_key_exists("discussions", $context) ? $context["discussions"] : (function () { throw new RuntimeError('Variable "discussions" does not exist.', 107, $this->source); })())) != 1)) ? ("s") : (""));
        yield " for \"<strong>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 107, $this->source); })()), "html", null, true);
        yield "</strong>\"
                </p>
                
                <!-- Search Form -->
                <form action=\"";
        // line 111
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_search");
        yield "\" method=\"GET\" class=\"d-flex justify-content-center mt-4\">
                    <input type=\"text\" name=\"q\" value=\"";
        // line 112
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 112, $this->source); })()), "html", null, true);
        yield "\" class=\"form-control\" style=\"background: white; color: #333; border: 1px solid #ddd; max-width: 400px;\" placeholder=\"Search discussions...\">
                    <button type=\"submit\" class=\"template-btn btn-style-one ms-2\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Search</span>
                            <span class=\"text-two\">Search</span>
                        </span>
                    </button>
                </form>
            </div>

            <!-- Results List -->
            ";
        // line 123
        if ((($tmp = (isset($context["discussions"]) || array_key_exists("discussions", $context) ? $context["discussions"] : (function () { throw new RuntimeError('Variable "discussions" does not exist.', 123, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 124
            yield "                <div class=\"results-list\">
                    ";
            // line 125
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["discussions"]) || array_key_exists("discussions", $context) ? $context["discussions"] : (function () { throw new RuntimeError('Variable "discussions" does not exist.', 125, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["discussion"]) {
                // line 126
                yield "                        <div class=\"result-item\" style=\"background: rgba(255,255,255,0.05); border-radius: 15px; padding: 25px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;\">
                            <div class=\"row align-items-center\">
                                <div class=\"col-lg-8\">
                                    <h4 class=\"result-title mb-2\">
                                        <a href=\"";
                // line 130
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "id", [], "any", false, false, false, 130)]), "html", null, true);
                yield "\" style=\"color: white; text-decoration: none; font-size: 1.3rem;\">
                                            ";
                // line 131
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 131), "html", null, true);
                yield "
                                        </a>
                                    </h4>
                                    <p class=\"result-preview mb-3\" style=\"color: rgba(255,255,255,0.7);\">
                                        ";
                // line 135
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "content", [], "any", false, false, false, 135), 0, 200), "html", null, true);
                yield "...
                                    </p>
                                    <div class=\"result-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 14px;\">
                                        <span><i class=\"fa fa-user\"></i> ";
                // line 138
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "authorName", [], "any", false, false, false, 138), "html", null, true);
                yield "</span>
                                        <span class=\"ms-3\"><i class=\"fa fa-clock\"></i> ";
                // line 139
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "createdAt", [], "any", false, false, false, 139), "M d, Y H:i"), "html", null, true);
                yield "</span>
                                        <span class=\"ms-3\"><i class=\"fa fa-folder\"></i> <a href=\"";
                // line 140
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_category", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "category", [], "any", false, false, false, 140), "id", [], "any", false, false, false, 140)]), "html", null, true);
                yield "\" style=\"color: #667eea;\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "category", [], "any", false, false, false, 140), "name", [], "any", false, false, false, 140), "html", null, true);
                yield "</a></span>
                                        ";
                // line 141
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "updatedAt", [], "any", false, false, false, 141) > CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "createdAt", [], "any", false, false, false, 141))) {
                    // line 142
                    yield "                                            <span class=\"ms-3\"><i class=\"fa fa-edit\"></i> Updated ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "updatedAt", [], "any", false, false, false, 142), "M d, Y H:i"), "html", null, true);
                    yield "</span>
                                        ";
                }
                // line 144
                yield "                                    </div>
                                </div>
                                <div class=\"col-lg-4 text-right\">
                                    <div class=\"result-stats\">
                                        <div class=\"stat-item mb-2\">
                                            <span class=\"stat-number\" style=\"color: #667eea; font-size: 1.5rem; font-weight: bold;\">";
                // line 149
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "messageCount", [], "any", true, true, false, 149)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "messageCount", [], "any", false, false, false, 149), 0)) : (0)), "html", null, true);
                yield "</span>
                                            <div class=\"stat-label\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">REPLIES</div>
                                        </div>
                                        <a href=\"";
                // line 152
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "id", [], "any", false, false, false, 152)]), "html", null, true);
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
            // line 160
            yield "                </div>
            ";
        } else {
            // line 162
            yield "                <div class=\"no-results text-center\" style=\"padding: 80px 0;\">
                    <i class=\"fa fa-search fa-5x mb-4\" style=\"color: rgba(255,255,255,0.3);\"></i>
                    <h3 class=\"text-white mb-3\">No Results Found</h3>
                    <p class=\"text-white-50 mb-4\">No discussions found matching \"";
            // line 165
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["query"]) || array_key_exists("query", $context) ? $context["query"] : (function () { throw new RuntimeError('Variable "query" does not exist.', 165, $this->source); })()), "html", null, true);
            yield "\". Try different keywords or browse categories.</p>
                    <div class=\"d-flex justify-content-center gap-3\">
                        <a href=\"";
            // line 167
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
            yield "\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Browse Forum</span>
                                <span class=\"text-two\">Browse Forum</span>
                            </span>
                        </a>
                        <a href=\"";
            // line 173
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_new_discussion");
            yield "\" class=\"template-btn btn-style-two\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Start Discussion</span>
                                <span class=\"text-two\">Start Discussion</span>
                            </span>
                        </a>
                    </div>
                </div>
            ";
        }
        // line 182
        yield "        </div>
    </section>
</div>

<style>
.result-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    background: rgba(255,255,255,0.08) !important;
}

.text-white-50 {
    color: rgba(255,255,255,0.5) !important;
}

.stat-item {
    display: inline-block;
    text-align: center;
    min-width: 80px;
}

/* Highlight search terms */
.highlight {
    background: rgba(255, 235, 59, 0.3);
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: 600;
}
</style>

<!-- Scripts -->
<script src=\"";
        // line 213
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.js"), "html", null, true);
        yield "\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);
});

// Custom highlight function (you may need to implement this in Twig)
function highlightText(text, query) {
    if (!query) return text;
    var regex = new RegExp('(' + query + ')', 'gi');
    return text.replace(regex, '<span class=\"highlight\">\$1</span>');
}
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
        return "forum/search_results.html.twig";
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
        return array (  415 => 213,  382 => 182,  370 => 173,  361 => 167,  356 => 165,  351 => 162,  347 => 160,  333 => 152,  327 => 149,  320 => 144,  314 => 142,  312 => 141,  306 => 140,  302 => 139,  298 => 138,  292 => 135,  285 => 131,  281 => 130,  275 => 126,  271 => 125,  268 => 124,  266 => 123,  252 => 112,  248 => 111,  237 => 107,  216 => 88,  206 => 81,  196 => 75,  186 => 68,  177 => 62,  172 => 61,  170 => 60,  158 => 51,  154 => 50,  133 => 34,  103 => 6,  90 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Search Results for \"{{ query }}\" - Forum - {{ parent() }}{% endblock %}

{% block body %}
<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"S\" class=\"letters-loading\">S</span>
                        <span data-text-preloader=\"E\" class=\"letters-loading\">E</span>
                        <span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
                        <span data-text-preloader=\"R\" class=\"letters-loading\">R</span>
                        <span data-text-preloader=\"C\" class=\"letters-loading\">C</span>
                        <span data-text-preloader=\"H\" class=\"letters-loading\">H</span>
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
                                        <li class=\"current\"><a href=\"#\">Search Results</a></li>
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

    <!-- Search Results -->
    <section class=\"search-results-section\" style=\"padding: 60px 0;\">
        <div class=\"auto-container\">
            <!-- Search Header -->
            <div class=\"search-header text-center mb-5\">
                <h2 class=\"text-white mb-3\">Search Results</h2>
                <p class=\"text-white-50\">
                    Found {{ discussions|length }} result{{ discussions|length != 1 ? 's' : '' }} for \"<strong>{{ query }}</strong>\"
                </p>
                
                <!-- Search Form -->
                <form action=\"{{ path('forum_search') }}\" method=\"GET\" class=\"d-flex justify-content-center mt-4\">
                    <input type=\"text\" name=\"q\" value=\"{{ query }}\" class=\"form-control\" style=\"background: white; color: #333; border: 1px solid #ddd; max-width: 400px;\" placeholder=\"Search discussions...\">
                    <button type=\"submit\" class=\"template-btn btn-style-one ms-2\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Search</span>
                            <span class=\"text-two\">Search</span>
                        </span>
                    </button>
                </form>
            </div>

            <!-- Results List -->
            {% if discussions %}
                <div class=\"results-list\">
                    {% for discussion in discussions %}
                        <div class=\"result-item\" style=\"background: rgba(255,255,255,0.05); border-radius: 15px; padding: 25px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;\">
                            <div class=\"row align-items-center\">
                                <div class=\"col-lg-8\">
                                    <h4 class=\"result-title mb-2\">
                                        <a href=\"{{ path('forum_discussion', {'id': discussion.id}) }}\" style=\"color: white; text-decoration: none; font-size: 1.3rem;\">
                                            {{ discussion.title }}
                                        </a>
                                    </h4>
                                    <p class=\"result-preview mb-3\" style=\"color: rgba(255,255,255,0.7);\">
                                        {{ discussion.content|slice(0, 200) }}...
                                    </p>
                                    <div class=\"result-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 14px;\">
                                        <span><i class=\"fa fa-user\"></i> {{ discussion.authorName }}</span>
                                        <span class=\"ms-3\"><i class=\"fa fa-clock\"></i> {{ discussion.createdAt|date('M d, Y H:i') }}</span>
                                        <span class=\"ms-3\"><i class=\"fa fa-folder\"></i> <a href=\"{{ path('forum_category', {'id': discussion.category.id}) }}\" style=\"color: #667eea;\">{{ discussion.category.name }}</a></span>
                                        {% if discussion.updatedAt > discussion.createdAt %}
                                            <span class=\"ms-3\"><i class=\"fa fa-edit\"></i> Updated {{ discussion.updatedAt|date('M d, Y H:i') }}</span>
                                        {% endif %}
                                    </div>
                                </div>
                                <div class=\"col-lg-4 text-right\">
                                    <div class=\"result-stats\">
                                        <div class=\"stat-item mb-2\">
                                            <span class=\"stat-number\" style=\"color: #667eea; font-size: 1.5rem; font-weight: bold;\">{{ discussion.messageCount|default(0) }}</span>
                                            <div class=\"stat-label\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">REPLIES</div>
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
                <div class=\"no-results text-center\" style=\"padding: 80px 0;\">
                    <i class=\"fa fa-search fa-5x mb-4\" style=\"color: rgba(255,255,255,0.3);\"></i>
                    <h3 class=\"text-white mb-3\">No Results Found</h3>
                    <p class=\"text-white-50 mb-4\">No discussions found matching \"{{ query }}\". Try different keywords or browse categories.</p>
                    <div class=\"d-flex justify-content-center gap-3\">
                        <a href=\"{{ path('forum_index') }}\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Browse Forum</span>
                                <span class=\"text-two\">Browse Forum</span>
                            </span>
                        </a>
                        <a href=\"{{ path('forum_new_discussion') }}\" class=\"template-btn btn-style-two\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Start Discussion</span>
                                <span class=\"text-two\">Start Discussion</span>
                            </span>
                        </a>
                    </div>
                </div>
            {% endif %}
        </div>
    </section>
</div>

<style>
.result-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    background: rgba(255,255,255,0.08) !important;
}

.text-white-50 {
    color: rgba(255,255,255,0.5) !important;
}

.stat-item {
    display: inline-block;
    text-align: center;
    min-width: 80px;
}

/* Highlight search terms */
.highlight {
    background: rgba(255, 235, 59, 0.3);
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: 600;
}
</style>

<!-- Scripts -->
<script src=\"{{ asset('assets_front/js/jquery.js') }}\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);
});

// Custom highlight function (you may need to implement this in Twig)
function highlightText(text, query) {
    if (!query) return text;
    var regex = new RegExp('(' + query + ')', 'gi');
    return text.replace(regex, '<span class=\"highlight\">\$1</span>');
}
</script>
{% endblock %}
", "forum/search_results.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\forum\\search_results.html.twig");
    }
}
