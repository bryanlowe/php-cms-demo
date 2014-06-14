<?php

/* projects/main.html */
class __TwigTemplate_21cf89e64deb7f580124d9116def00994fb8e05c4c1d91b3979aa74faac2095f extends Twig_Template
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
\t\t<div class=\"col-lg-8 col-lg-offset-2\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Update or Add Projects</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"projects_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("projects/projects_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"clients_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 16
        $this->env->loadTemplate("projects/clients_select.html")->display($context);
        // line 17
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t";
        // line 19
        echo (isset($context["PROJECT_FORM"]) ? $context["PROJECT_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<label>Current Tags</label>
\t\t\t\t\t<div id=\"current_tags\" class=\"list-group\" style=\"border: 1px solid #000; padding: 10px;\">
\t\t\t\t\t\t";
        // line 23
        $this->env->loadTemplate("projects/current_tags.html")->display($context);
        // line 24
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div class=\"button_panel\" style=\"margin-left: 240px;\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-danger\" value=\"DELETE\" name=\"deleteBtn\" id=\"deleteBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"RESET\" name=\"resetBtn\" id=\"resetBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "projects/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 24,  61 => 23,  54 => 19,  50 => 17,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
