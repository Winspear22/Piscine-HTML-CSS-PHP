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

/* create_table.html.twig */
class __TwigTemplate_82c6b4ba20bfb21ac88c6b5e81869dde extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "create_table.html.twig"));

        // line 1
        yield "<form method=\"get\" action=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex00_create_table");
        yield "\">
    <button type=\"submit\">Créer la table</button>
</form>

<form method=\"get\" action=\"";
        // line 5
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex00_delete_table");
        yield "\">
    <button type=\"submit\">Supprimer la table</button>
</form>

<form method=\"get\" action=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex00_show_table");
        yield "\">
    <button type=\"submit\">Afficher la table</button>
</form>

";
        // line 13
        if (array_key_exists("message", $context)) {
            // line 14
            yield "    <p>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 14, $this->source); })()), "html", null, true);
            yield "</p>
";
        }
        // line 16
        yield "
";
        // line 17
        if ((array_key_exists("users", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 17, $this->source); })())) > 0))) {
            // line 18
            yield "    <table border=\"1\">
        <thead>
            <tr>
                ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::keys(CoreExtension::getAttribute($this->env, $this->source, (isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 21, $this->source); })()), 0, [], "array", false, false, false, 21)));
            foreach ($context['_seq'] as $context["_key"] => $context["key"]) {
                // line 22
                yield "                    <th>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                yield "</th>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['key'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            yield "            </tr>
        </thead>
        <tbody>
            ";
            // line 27
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 27, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
                // line 28
                yield "                <tr>
                    ";
                // line 29
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable($context["user"]);
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 30
                    yield "                        <td>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
                    yield "</td>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 32
                yield "                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['user'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            yield "        </tbody>
    </table>
";
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "create_table.html.twig";
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
        return array (  130 => 34,  123 => 32,  114 => 30,  110 => 29,  107 => 28,  103 => 27,  98 => 24,  89 => 22,  85 => 21,  80 => 18,  78 => 17,  75 => 16,  69 => 14,  67 => 13,  60 => 9,  53 => 5,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<form method=\"get\" action=\"{{ path('ex00_create_table') }}\">
    <button type=\"submit\">Créer la table</button>
</form>

<form method=\"get\" action=\"{{ path('ex00_delete_table') }}\">
    <button type=\"submit\">Supprimer la table</button>
</form>

<form method=\"get\" action=\"{{ path('ex00_show_table') }}\">
    <button type=\"submit\">Afficher la table</button>
</form>

{% if message is defined %}
    <p>{{ message }}</p>
{% endif %}

{% if users is defined and users|length > 0 %}
    <table border=\"1\">
        <thead>
            <tr>
                {% for key in users[0]|keys %}
                    <th>{{ key }}</th>
                {% endfor %}
            </tr>
        </thead>
        <tbody>
            {% for user in users %}
                <tr>
                    {% for key, value in user %}
                        <td>{{ value }}</td>
                    {% endfor %}
                </tr>
            {% endfor %}
        </tbody>
    </table>
{% endif %}
", "create_table.html.twig", "/home/user42/Desktop/13-04-2025/Day-05-restart/ex00/templates/create_table.html.twig");
    }
}
