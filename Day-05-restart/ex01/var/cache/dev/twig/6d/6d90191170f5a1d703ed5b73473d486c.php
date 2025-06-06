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
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Ex01 - ORM</title>
</head>
<body>
    <h1>Créer la table avec ORM</h1>

    ";
        // line 10
        if (array_key_exists("message", $context)) {
            // line 11
            yield "        <p>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 11, $this->source); })()), "html", null, true);
            yield "</p>
    ";
        }
        // line 13
        yield "
    <form method=\"get\" action=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex01_create_table");
        yield "\">
        <button type=\"submit\">Créer la table</button>
    </form>
    
    <form method=\"get\" action=\"";
        // line 18
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex01_delete_table");
        yield "\">
        <button type=\"submit\">Supprimer la table</button>
    </form>

</body>
</html>
";
        
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
        return array (  74 => 18,  67 => 14,  64 => 13,  58 => 11,  56 => 10,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Ex01 - ORM</title>
</head>
<body>
    <h1>Créer la table avec ORM</h1>

    {% if message is defined %}
        <p>{{ message }}</p>
    {% endif %}

    <form method=\"get\" action=\"{{ path('ex01_create_table') }}\">
        <button type=\"submit\">Créer la table</button>
    </form>
    
    <form method=\"get\" action=\"{{ path('ex01_delete_table') }}\">
        <button type=\"submit\">Supprimer la table</button>
    </form>

</body>
</html>
", "create_table.html.twig", "/home/adnen/Desktop/06-05-2025/Day-05-restart/ex01/templates/create_table.html.twig");
    }
}
