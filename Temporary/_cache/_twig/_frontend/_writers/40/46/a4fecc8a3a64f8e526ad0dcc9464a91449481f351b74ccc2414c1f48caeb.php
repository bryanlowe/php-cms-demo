<?php

/* projects/main.html */
class __TwigTemplate_4046a4fecc8a3a64f8e526ad0dcc9464a91449481f351b74ccc2414c1f48caeb extends Twig_Template
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
        echo "<div id=\"container\">
\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-tasks\"></i> Project Assignments</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t\t<table id=\"projectTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t\t\t\t\t\t<thead>
\t\t                    \t<tr>
\t\t\t                        <th class=\"header\">Title <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Last Updated <i class=\"fa fa-sort\"></i></th>
\t\t                      \t</tr>
\t                      \t</thead>
\t                      \t<tbody id=\"project_entries\">
              \t\t\t\t\t";
        // line 21
        $this->env->loadTemplate("projects/project-entry.html")->display($context);
        // line 22
        echo "              \t\t\t\t</tbody>
                 \t \t</table>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t";
        // line 31
        if (((isset($context["WRITER_TYPE"]) ? $context["WRITER_TYPE"] : null) == "EDITOR")) {
            // line 32
            echo "\t\t\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-search\"></i> Project Managment</h3>
\t\t\t\t\t";
        } else {
            // line 34
            echo "\t\t\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-search\"></i> Project Hours</h3>
\t\t\t\t\t";
        }
        // line 36
        echo "\t\t\t\t</div>
\t\t\t\t<div id=\"projectDesc\" class=\"panel-body\">
\t\t\t\t\t<input type=\"hidden\" value=\"\" id=\"project_id\" />
\t\t\t\t\t";
        // line 39
        if (((isset($context["WRITER_TYPE"]) ? $context["WRITER_TYPE"] : null) == "EDITOR")) {
            // line 40
            echo "\t\t\t\t\t\t<div id=\"project_assignment_control\">
\t\t\t\t\t\t\t<h2>Assign a writer to: <span class=\"curr-title\"></span></h2>
\t\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t\t<div id=\"writers_select_container\" class=\"input_container\">
\t\t\t\t\t\t\t\t";
            // line 44
            $this->env->loadTemplate("projects/writers_select.html")->display($context);
            // line 45
            echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"button_panel\" style=\"margin-top: 26px;\">
\t\t\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"ADD WRITER\" name=\"addBtn\" id=\"addBtn\">
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t\t\t";
            // line 52
            $this->env->loadTemplate("projects/writer-list.html")->display($context);
            // line 53
            echo "\t\t\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t\t\t<div class=\"clear\"></div>\t
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        // line 57
        echo "\t\t\t\t\t<div id=\"project_hours_control\">
\t\t\t\t\t\t<h2>Record your hours for: <span class=\"curr-title\"></span></h2>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t<input type=\"hidden\" value=\"\" id=\"work_id\" />
\t\t\t\t\t\t<div id=\"datepicker_container\" class=\"input_container\">
\t\t\t\t\t\t\t<label for=\"datepicker\">Pick a date</label><br>
\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"datepicker\" id=\"datepicker\" />
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div id=\"hours_container\" class=\"input_container\">
\t\t\t\t\t\t\t<label for=\"hours\">How many hours?</label><br>
\t\t\t\t\t\t\t<select class=\"form-control\" name=\"hours\" id=\"hours\">
\t\t\t\t\t\t\t\t<option value=\"\">Select hours</option>
\t\t\t\t\t\t\t\t<option value=\"0\">0</option>
\t\t\t\t\t\t\t\t<option value=\"0.25\">0.25</option>
\t\t\t\t\t\t\t\t<option value=\"0.5\">0.5</option>
\t\t\t\t\t\t\t\t<option value=\"0.75\">0.75</option>
\t\t\t\t\t\t\t\t<option value=\"1\">1</option>
\t\t\t\t\t\t\t\t<option value=\"1.25\">1.25</option>
\t\t\t\t\t\t\t\t<option value=\"1.5\">1.5</option>
\t\t\t\t\t\t\t\t<option value=\"1.75\">1.75</option>
\t\t\t\t\t\t\t\t<option value=\"2\">2</option>
\t\t\t\t\t\t\t\t<option value=\"2.25\">2.25</option>
\t\t\t\t\t\t\t\t<option value=\"2.5\">2.5</option>
\t\t\t\t\t\t\t\t<option value=\"2.75\">2.75</option>
\t\t\t\t\t\t\t\t<option value=\"3\">3</option>
\t\t\t\t\t\t\t\t<option value=\"3.25\">3.25</option>
\t\t\t\t\t\t\t\t<option value=\"3.5\">3.5</option>
\t\t\t\t\t\t\t\t<option value=\"3.75\">3.75</option>
\t\t\t\t\t\t\t\t<option value=\"4\">4</option>
\t\t\t\t\t\t\t\t<option value=\"4.25\">4.25</option>
\t\t\t\t\t\t\t\t<option value=\"4.5\">4.5</option>
\t\t\t\t\t\t\t\t<option value=\"4.75\">4.75</option>
\t\t\t\t\t\t\t\t<option value=\"5\">5</option>
\t\t\t\t\t\t\t\t<option value=\"5.25\">5.25</option>
\t\t\t\t\t\t\t\t<option value=\"5.5\">5.5</option>
\t\t\t\t\t\t\t\t<option value=\"5.75\">5.75</option>
\t\t\t\t\t\t\t\t<option value=\"6\">6</option>
\t\t\t\t\t\t\t\t<option value=\"6.25\">5.25</option>
\t\t\t\t\t\t\t\t<option value=\"6.5\">6.5</option>
\t\t\t\t\t\t\t\t<option value=\"6.75\">6.75</option>
\t\t\t\t\t\t\t\t<option value=\"7\">7</option>
\t\t\t\t\t\t\t\t<option value=\"7.25\">7.25</option>
\t\t\t\t\t\t\t\t<option value=\"7.5\">7.5</option>
\t\t\t\t\t\t\t\t<option value=\"7.75\">7.75</option>
\t\t\t\t\t\t\t\t<option value=\"8\">8</option>
\t\t\t\t\t\t\t\t<option value=\"8.25\">8.25</option>
\t\t\t\t\t\t\t\t<option value=\"8.5\">8.5</option>
\t\t\t\t\t\t\t\t<option value=\"8.75\">8.75</option>
\t\t\t\t\t\t\t\t<option value=\"9\">9</option>
\t\t\t\t\t\t\t\t<option value=\"9.25\">9.25</option>
\t\t\t\t\t\t\t\t<option value=\"9.5\">9.5</option>
\t\t\t\t\t\t\t\t<option value=\"9.75\">9.75</option>
\t\t\t\t\t\t\t\t<option value=\"10\">10</option>
\t\t\t\t\t\t\t\t<option value=\"10.25\">10.25</option>
\t\t\t\t\t\t\t\t<option value=\"10.5\">10.5</option>
\t\t\t\t\t\t\t\t<option value=\"10.75\">10.75</option>
\t\t\t\t\t\t\t\t<option value=\"11\">11</option>
\t\t\t\t\t\t\t\t<option value=\"11.25\">11.25</option>
\t\t\t\t\t\t\t\t<option value=\"11.5\">11.5</option>
\t\t\t\t\t\t\t\t<option value=\"11.75\">11.75</option>
\t\t\t\t\t\t\t\t<option value=\"12\">12</option>
\t\t\t\t\t\t\t\t<option value=\"12.25\">12.25</option>
\t\t\t\t\t\t\t\t<option value=\"12.5\">12.5</option>
\t\t\t\t\t\t\t\t<option value=\"12.75\">12.75</option>
\t\t\t\t\t\t\t\t<option value=\"13\">13</option>
\t\t\t\t\t\t\t\t<option value=\"13.25\">13.25</option>
\t\t\t\t\t\t\t\t<option value=\"13.5\">13.5</option>
\t\t\t\t\t\t\t\t<option value=\"13.75\">13.75</option>
\t\t\t\t\t\t\t\t<option value=\"14\">14</option>
\t\t\t\t\t\t\t\t<option value=\"14.25\">14.25</option>
\t\t\t\t\t\t\t\t<option value=\"14.5\">14.5</option>
\t\t\t\t\t\t\t\t<option value=\"14.75\">14.75</option>
\t\t\t\t\t\t\t\t<option value=\"15\">15</option>
\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t<div id=\"work_description_container\" class=\"input_container\">
\t\t\t\t\t\t\t<label for=\"work_description\">Work Description</label><br>
\t\t\t\t\t\t\t<textarea id=\"work_description\" class=\"form-control\" style=\"width: 400px;\"></textarea>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"RESET\" name=\"resetBtn\" id=\"resetBtn\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t</div>
\t\t\t\t\t";
        // line 148
        $this->env->loadTemplate("projects/project-hours.html")->display($context);
        // line 149
        echo "\t\t\t\t</div>
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
        return array (  200 => 149,  198 => 148,  105 => 57,  99 => 53,  97 => 52,  88 => 45,  86 => 44,  80 => 40,  78 => 39,  73 => 36,  69 => 34,  65 => 32,  63 => 31,  52 => 22,  50 => 21,  31 => 4,  28 => 3,);
    }
}
