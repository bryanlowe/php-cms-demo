<?php

/* account/main.html */
class __TwigTemplate_da1eba488c43b67fac78a46f99fc6e23e1dd149012afb8d5b2690a56be245fa1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("_common/base.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "_common/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"container\">
\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Edit Account Information</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t";
        // line 12
        echo (isset($context["WRITER_FORM"]) ? $context["WRITER_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Performance Statistics</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t";
        // line 28
        if ((isset($context["RATING"]) ? $context["RATING"] : null)) {
            // line 29
            echo "\t\t\t\t\t<h2>Rating: ";
            echo (isset($context["RATING"]) ? $context["RATING"] : null);
            echo "</h2>
\t\t\t\t\t";
        } else {
            // line 31
            echo "\t\t\t\t\t<h2>Rating: N/A</h2>
\t\t\t\t\t";
        }
        // line 33
        echo "\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t";
        // line 34
        if ((isset($context["WPH"]) ? $context["WPH"] : null)) {
            // line 35
            echo "\t\t\t\t\t<h2>Words Per Hour: ";
            echo (isset($context["WPH"]) ? $context["WPH"] : null);
            echo "</h2>
\t\t\t\t\t";
        } else {
            // line 37
            echo "\t\t\t\t\t<h2>Words Per Hour: N/A</h2>
\t\t\t\t\t";
        }
        // line 39
        echo "\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<p><i>* as of ";
        // line 40
        echo (isset($context["AS_OF_DATE"]) ? $context["AS_OF_DATE"] : null);
        echo "</i></p>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "account/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 40,  87 => 39,  83 => 37,  77 => 35,  75 => 34,  72 => 33,  68 => 31,  62 => 29,  60 => 28,  41 => 12,  31 => 4,  28 => 3,);
    }
}
