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

/* dashboard/users.html.twig */
class __TwigTemplate_5ebe063a8ec554356520a4fe677dd88a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/users.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/users.html.twig"));

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

        yield "Gestion des utilisateurs";
        
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
        yield "<div class=\"container-fluid mt-4\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white d-flex justify-content-between align-items-center\">Utilisateurs</div>
                <div class=\"card-body\">
                    <table class=\"table\">
                        <thead>
                            <tr><th>Photo</th><th>Nom</th><th>Email</th><th>Rôles</th><th>Statut</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 17, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
            // line 18
            yield "                                <tr>
                                    <td>
                                        <img src=\"";
            // line 20
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "photo", [], "any", false, false, false, 20)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/profiles/" . CoreExtension::getAttribute($this->env, $this->source, $context["u"], "photo", [], "any", false, false, false, 20))), "html", null, true)) : ("https://via.placeholder.com/40"));
            yield "\" 
                                             alt=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "firstName", [], "any", false, false, false, 21) . " ") . CoreExtension::getAttribute($this->env, $this->source, $context["u"], "lastName", [], "any", false, false, false, 21))), "html", null, true);
            yield "\" 
                                             class=\"rounded-circle\" 
                                             style=\"width:40px; height:40px; object-fit:cover; border:1px solid #dee2e6;\">
                                    </td>
                                    <td>";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "firstName", [], "any", false, false, false, 25) . " ") . CoreExtension::getAttribute($this->env, $this->source, $context["u"], "lastName", [], "any", false, false, false, 25))), "html", null, true);
            yield "</td>
                                    <td>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "email", [], "any", false, false, false, 26), "html", null, true);
            yield "</td>
                                    <td>
                                        ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "roles", [], "any", false, false, false, 28));
            foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
                // line 29
                yield "                                            ";
                if (($context["role"] != "ROLE_USER")) {
                    // line 30
                    yield "                                                <span class=\"badge bg-";
                    yield ((($context["role"] == "ROLE_ADMIN")) ? ("danger") : ("primary"));
                    yield " me-1\">
                                                    ";
                    // line 31
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::replace($context["role"], ["ROLE_" => ""]), "html", null, true);
                    yield "
                                                </span>
                                            ";
                }
                // line 34
                yield "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['role'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            yield "                                    </td>
                                    <td>
                                        <span class=\"badge bg-";
            // line 37
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 37) == "active")) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 37) == "inactive")) ? ("danger") : ("warning"))));
            yield "\">
                                            ";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["u"], "status", [], "any", false, false, false, 38)), "html", null, true);
            yield "
                                        </span>
                                    </td>
                                    <td>
                                        <button class=\"btn btn-sm btn-outline-primary\" onclick=\"editUser(";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 42), "html", null, true);
            yield ")\">
                                            <i class=\"fas fa-edit\"></i>
                                        </button>
                                    </td>
                                </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 47
        if (!$context['_iterated']) {
            // line 48
            yield "                                <tr><td colspan=\"6\">Aucun utilisateur</td></tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['u'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        yield "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
        return "dashboard/users.html.twig";
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
        return array (  200 => 50,  193 => 48,  191 => 47,  181 => 42,  174 => 38,  170 => 37,  166 => 35,  160 => 34,  154 => 31,  149 => 30,  146 => 29,  142 => 28,  137 => 26,  133 => 25,  126 => 21,  122 => 20,  118 => 18,  113 => 17,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Gestion des utilisateurs{% endblock %}

{% block body %}
<div class=\"container-fluid mt-4\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white d-flex justify-content-between align-items-center\">Utilisateurs</div>
                <div class=\"card-body\">
                    <table class=\"table\">
                        <thead>
                            <tr><th>Photo</th><th>Nom</th><th>Email</th><th>Rôles</th><th>Statut</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            {% for u in users %}
                                <tr>
                                    <td>
                                        <img src=\"{{ u.photo ? asset('uploads/profiles/' ~ u.photo) : 'https://via.placeholder.com/40' }}\" 
                                             alt=\"{{ (u.firstName ~ ' ' ~ u.lastName)|trim }}\" 
                                             class=\"rounded-circle\" 
                                             style=\"width:40px; height:40px; object-fit:cover; border:1px solid #dee2e6;\">
                                    </td>
                                    <td>{{ (u.firstName ~ ' ' ~ u.lastName)|trim }}</td>
                                    <td>{{ u.email }}</td>
                                    <td>
                                        {% for role in u.roles %}
                                            {% if role != 'ROLE_USER' %}
                                                <span class=\"badge bg-{{ role == 'ROLE_ADMIN' ? 'danger' : 'primary' }} me-1\">
                                                    {{ role|replace({'ROLE_': ''}) }}
                                                </span>
                                            {% endif %}
                                        {% endfor %}
                                    </td>
                                    <td>
                                        <span class=\"badge bg-{{ u.status == 'active' ? 'success' : (u.status == 'inactive' ? 'danger' : 'warning') }}\">
                                            {{ u.status|capitalize }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class=\"btn btn-sm btn-outline-primary\" onclick=\"editUser({{ u.id }})\">
                                            <i class=\"fas fa-edit\"></i>
                                        </button>
                                    </td>
                                </tr>
                            {% else %}
                                <tr><td colspan=\"6\">Aucun utilisateur</td></tr>
                            {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}", "dashboard/users.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\dashboard\\users.html.twig");
    }
}
