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
class __TwigTemplate_ea39d5e8caf6307f961821e3b65f2783 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Gestion de la table</title>
    ";
        // line 6
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 9
        yield "</head>
<body>
    <h1>Ex00 - Gestion de la table 'users' popo</h1>

    ";
        // line 13
        if (array_key_exists("message", $context)) {
            // line 14
            yield "        <p>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["message"] ?? null), "html", null, true);
            yield "</p>
    ";
        }
        // line 16
        yield "
    <form method=\"get\" action=\"";
        // line 17
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex00_create_table");
        yield "\">
        <button type=\"submit\">Créer la table</button>
    </form>

    <form method=\"get\" action=\"";
        // line 21
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex00_delete_table");
        yield "\">
        <button type=\"submit\">Supprimer la table</button>
    </form>
</body>
</html>
";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield " <link rel=\"stylesheet\" href=\"/style.css\">    
    ";
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
        return array (  94 => 7,  87 => 6,  76 => 21,  69 => 17,  66 => 16,  60 => 14,  58 => 13,  52 => 9,  50 => 6,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "create_table.html.twig", "/home/adnen/Desktop/06-05-2025/Day-05-restart/ex00/templates/create_table.html.twig");
    }
}
