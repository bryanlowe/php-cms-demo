<?php

/* users/main.html */
class __TwigTemplate_2ef911b8b9edfd8d3960e09d6378c421c4450e2bcbbde5b106a6f9c87242420d extends Twig_Template
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
\t\t<div class=\"col-lg-4 col-lg-offset-2\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Update or Add User</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"users_select_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("users/users_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t";
        // line 16
        echo (isset($context["USER_FORM"]) ? $context["USER_FORM"] : null);
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
\t\t\t\t\t<h3 class=\"panel-title\">Click on an entry you want to create as a user</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"client-writer-list\" class=\"list-group\">
\t\t\t\t\t\t";
        // line 38
        if (((isset($context["NONUSER_CLIENTS"]) ? $context["NONUSER_CLIENTS"] : null) || (isset($context["NONUSER_WRITERS"]) ? $context["NONUSER_WRITERS"] : null))) {
            // line 39
            echo "\t\t\t\t\t\t\t";
            $this->env->loadTemplate("users/list-group-item.html")->display($context);
            // line 40
            echo "\t\t\t\t\t\t";
        } else {
            // line 41
            echo "\t\t\t\t\t\t\t<h2 class=\"no-entries\" align=\"center\">No new entries</h2>
\t\t\t\t\t\t";
        }
        // line 43
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "users/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 43,  81 => 41,  78 => 40,  75 => 39,  73 => 38,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
