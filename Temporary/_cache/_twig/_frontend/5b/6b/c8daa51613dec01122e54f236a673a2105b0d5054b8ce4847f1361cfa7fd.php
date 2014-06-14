<?php

/* projects/main.html */
class __TwigTemplate_5b6bc8daa51613dec01122e54f236a673a2105b0d5054b8ce4847f1361cfa7fd extends Twig_Template
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
\t\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-tasks\"></i> Projects</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t\t<table id=\"projectTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t\t\t\t\t\t<thead>
\t\t                    \t<tr>
\t\t\t                        <th class=\"header\">Title <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Status <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Last Updated <i class=\"fa fa-sort\"></i></th>
\t\t                      \t</tr>
\t                      \t</thead>
\t                      \t<tbody id=\"project_entries\">
              \t\t\t\t\t";
        // line 22
        $this->env->loadTemplate("projects/project-entry.html")->display($context);
        // line 23
        echo "              \t\t\t\t</tbody>
                 \t \t</table>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-search\"></i> Project Description</h3>
\t\t\t\t</div>
\t\t\t\t<div id=\"projectDesc\" class=\"panel-body\">
\t\t\t\t\t<p>Click on an project title to view its description.</p>
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
        return array (  53 => 23,  51 => 22,  31 => 4,  28 => 3,);
    }
}
