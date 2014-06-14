<?php

/* schedule/main.html */
class __TwigTemplate_02b9cb206a936503de3850fd77c2e2b74f9d5b191a6bfd6c7ab3e4b9560615b6 extends Twig_Template
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
        echo "<style>
\t.fc-event-time {
\t\tdisplay: none;
\t}
</style>
<div class=\"container\">
\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-12\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">View Writer Schedule</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"writers_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 18
        $this->env->loadTemplate("writers/writers_select.html")->display($context);
        // line 19
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"datepicker_container\" class=\"input_container\">
\t\t\t\t\t\t<label for=\"datepicker\">Pick a date</label><br>
\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"datepicker\" id=\"datepicker\" />
\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"hours_container\" class=\"input_container\">
\t\t\t\t\t\t<label for=\"hours\">How many hours?</label><br>
\t\t\t\t\t\t<select class=\"form-control\" name=\"hours\" id=\"hours\">
\t\t\t\t\t\t\t<option value=\"\">Select hours</option>
\t\t\t\t\t\t\t<option value=\"0\">0</option>
\t\t\t\t\t\t\t<option value=\"1\">1</option>
\t\t\t\t\t\t\t<option value=\"2\">2</option>
\t\t\t\t\t\t\t<option value=\"3\">3</option>
\t\t\t\t\t\t\t<option value=\"4\">4</option>
\t\t\t\t\t\t\t<option value=\"5\">5</option>
\t\t\t\t\t\t\t<option value=\"6\">6</option>
\t\t\t\t\t\t\t<option value=\"7\">7</option>
\t\t\t\t\t\t\t<option value=\"8\">8</option>
\t\t\t\t\t\t\t<option value=\"9\">9</option>
\t\t\t\t\t\t\t<option value=\"10\">10</option>
\t\t\t\t\t\t\t<option value=\"11\">11</option>
\t\t\t\t\t\t\t<option value=\"12\">12</option>
\t\t\t\t\t\t\t<option value=\"13\">13</option>
\t\t\t\t\t\t\t<option value=\"14\">14</option>
\t\t\t\t\t\t\t<option value=\"15\">15</option>
\t\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"button_panel\" style=\"margin-top: 26px;\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"RESET\" name=\"resetBtn\" id=\"resetBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div id=\"writer-schedule\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "schedule/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 19,  47 => 18,  31 => 4,  28 => 3,);
    }
}
