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
\t<div class=\"row\">
\t\t<div class=\"col-lg-4 col-lg-offset-2\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Update or Add Projects</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"projects_select_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("projects/projects_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div id=\"clients_select_container\">
\t\t\t\t\t\t";
        // line 17
        $this->env->loadTemplate("projects/clients_select.html")->display($context);
        // line 18
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div id=\"tag_select_container\">
\t\t\t\t\t\t";
        // line 21
        $this->env->loadTemplate("projects/tag_select.html")->display($context);
        // line 22
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t";
        // line 24
        echo (isset($context["PROJECT_FORM"]) ? $context["PROJECT_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"button_panel\">
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
\t\t<div class=\"col-lg-4\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Update Timeline</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"project_tag_container\">
\t\t\t\t\t\t<label for=\"project_tag\">New Entry</label><br>
\t\t\t\t\t\t<textarea class=\"form-control\" name=\"description\" id=\"description\"></textarea>
\t\t\t\t\t</div>
\t\t\t\t\t<div style=\"margin-left:-20px;\" class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"UPDATE TIMELINE\" name=\"updateBtn\" id=\"updateBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div id=\"timeline-list\" class=\"list-group\">
\t\t\t\t\t\t";
        // line 56
        $this->env->loadTemplate("projects/list-group-item.html")->display($context);
        // line 57
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Project Timeline</h3>
\t\t\t\t</div>
\t\t\t\t<div id=\"timeline-desc\" class=\"panel-body\">
\t\t\t\t\t<p align=\"center\">Nothing to show</p>
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
        return array (  99 => 57,  97 => 56,  62 => 24,  58 => 22,  56 => 21,  51 => 18,  49 => 17,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
