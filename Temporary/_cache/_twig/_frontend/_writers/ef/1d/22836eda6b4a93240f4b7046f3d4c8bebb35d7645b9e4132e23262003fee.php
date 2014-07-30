<?php

/* feedback/main.html */
class __TwigTemplate_ef1d22836eda6b4a93240f4b7046f3d4c8bebb35d7645b9e4132e23262003fee extends Twig_Template
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
\t";
        // line 5
        if (((isset($context["WRITER_TYPE"]) ? $context["WRITER_TYPE"] : null) == "EDITOR")) {
            // line 6
            echo "\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Project Feedback</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"projects_select_container\">
\t\t\t\t\t\t";
            // line 14
            $this->env->loadTemplate("feedback/projects_select.html")->display($context);
            // line 15
            echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div id=\"writers_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
            // line 18
            $this->env->loadTemplate("feedback/writers_select.html")->display($context);
            // line 19
            echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t";
            // line 21
            echo (isset($context["FEEDBACK_FORM"]) ? $context["FEEDBACK_FORM"] : null);
            echo "
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SUBMIT FEEDBACK\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Feedback History</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t\t<table id=\"feedbackHistoryTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t\t\t\t\t\t<thead>
\t\t                    \t<tr>
\t\t\t                        <th class=\"header\">Project Title <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Date Reviewed <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Rating <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Words Per Hour <i class=\"fa fa-sort\"></i></th>
\t\t                      \t</tr>
\t                      \t</thead>
\t                      \t<tbody id=\"feedback_entries\">
\t                      \t\t";
            // line 48
            $this->env->loadTemplate("feedback/feedback-entry.html")->display($context);
            // line 49
            echo "              \t\t\t\t</tbody>
                 \t \t</table>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div id=\"writer-feedback\">
\t                    <p align=\"center\">There are no recent feedback details to show.</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        } else {
            // line 61
            echo "\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-12\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Feedback History</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t\t<table id=\"feedbackHistoryTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t\t\t\t\t\t<thead>
\t\t                    \t<tr>
\t\t\t                        <th class=\"header\">Project Title <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Date Reviewed <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Rating <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Words Per Hour <i class=\"fa fa-sort\"></i></th>
\t\t                      \t</tr>
\t                      \t</thead>
\t                      \t<tbody id=\"feedback_entries\">
\t                      \t\t";
            // line 79
            $this->env->loadTemplate("feedback/feedback-entry.html")->display($context);
            // line 80
            echo "              \t\t\t\t</tbody>
                 \t \t</table>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div id=\"writer-feedback\">
\t                    <p align=\"center\">There are no recent feedback details to show.</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        }
        // line 92
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "feedback/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 92,  127 => 80,  125 => 79,  105 => 61,  91 => 49,  89 => 48,  59 => 21,  55 => 19,  53 => 18,  48 => 15,  46 => 14,  36 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
