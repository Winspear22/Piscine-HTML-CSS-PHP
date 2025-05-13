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

/* select.html.twig */
class __TwigTemplate_adbf0957f9485319b31beed736713056 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "select.html.twig"));

        // line 1
        yield "<h1>Liste des utilisateurs</h1>

";
        // line 3
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 3, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 4
            yield "<table border=\"1\" cellpadding=\"5\">
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Enable</th>
        <th>Birthdate</th>
        <th>Address</th>
    </tr>
    ";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 14, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 15
                yield "    <tr>
        <td>";
                // line 16
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 16), "html", null, true);
                yield "</td>
        <td>";
                // line 17
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "username", [], "any", false, false, false, 17), "html", null, true);
                yield "</td>
        <td>";
                // line 18
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "name", [], "any", false, false, false, 18), "html", null, true);
                yield "</td>
        <td>";
                // line 19
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 19), "html", null, true);
                yield "</td>
        <td>";
                // line 20
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "enable", [], "any", false, false, false, 20)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Oui") : ("Non"));
                yield "</td>
        <td>";
                // line 21
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "birthdate", [], "any", false, false, false, 21), "Y-m-d"), "html", null, true);
                yield "</td>
        <td>";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "address", [], "any", false, false, false, 22), "html", null, true);
                yield "</td>
    </tr>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['user'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            yield "</table>
";
        } else {
            // line 27
            yield "    <p>Aucun utilisateur trouvé.</p>
";
        }
        // line 29
        yield "
<a href=\"";
        // line 30
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex03bundle_insert");
        yield "\">Ajouter un utilisateur</a>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "select.html.twig";
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
        return array (  114 => 30,  111 => 29,  107 => 27,  103 => 25,  94 => 22,  90 => 21,  86 => 20,  82 => 19,  78 => 18,  74 => 17,  70 => 16,  67 => 15,  63 => 14,  51 => 4,  49 => 3,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<h1>Liste des utilisateurs</h1>

{% if users is not empty %}
<table border=\"1\" cellpadding=\"5\">
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Enable</th>
        <th>Birthdate</th>
        <th>Address</th>
    </tr>
    {% for user in users %}
    <tr>
        <td>{{ user.id }}</td>
        <td>{{ user.username }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.enable ? 'Oui' : 'Non' }}</td>
        <td>{{ user.birthdate|date('Y-m-d') }}</td>
        <td>{{ user.address }}</td>
    </tr>
    {% endfor %}
</table>
{% else %}
    <p>Aucun utilisateur trouvé.</p>
{% endif %}

<a href=\"{{ path('ex03bundle_insert') }}\">Ajouter un utilisateur</a>
", "select.html.twig", "/home/adnen/Desktop/06-05-2025/Day-05-restart/ex03/templates/select.html.twig");
    }
}
