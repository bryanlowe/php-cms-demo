<?php

/* writers/performance-entry.html */
class __TwigTemplate_1f35ac0a10ecb77e4b24cc35372063d11265cb6d239f6be17e3b2e8f8c1f5e66 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ((isset($context["RATING"]) ? $context["RATING"] : null)) {
            // line 2
            echo "<h2>Rating: ";
            echo (isset($context["RATING"]) ? $context["RATING"] : null);
            echo "</h2>
";
        } else {
            // line 4
            echo "<h2>Rating: N/A</h2>
";
        }
        // line 6
        echo "<div class=\"clear\"></div>
";
        // line 7
        if ((isset($context["WPH"]) ? $context["WPH"] : null)) {
            // line 8
            echo "<h2>Words Per Hour: ";
            echo (isset($context["WPH"]) ? $context["WPH"] : null);
            echo "</h2>
";
        } else {
            // line 10
            echo "<h2>Words Per Hour: N/A</h2>
";
        }
        // line 12
        echo "<div class=\"clear\"></div>
";
        // line 13
        if ((isset($context["AS_OF_DATE"]) ? $context["AS_OF_DATE"] : null)) {
            // line 14
            echo "<p><i>* as of ";
            echo (isset($context["AS_OF_DATE"]) ? $context["AS_OF_DATE"] : null);
            echo "</i></p>
";
        }
    }

    public function getTemplateName()
    {
        return "writers/performance-entry.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 14,  49 => 13,  46 => 12,  36 => 8,  34 => 7,  27 => 4,  21 => 2,  39 => 7,  24 => 4,  19 => 1,  87 => 48,  85 => 47,  73 => 37,  71 => 36,  48 => 16,  44 => 14,  42 => 10,  31 => 6,  28 => 5,);
    }
}
