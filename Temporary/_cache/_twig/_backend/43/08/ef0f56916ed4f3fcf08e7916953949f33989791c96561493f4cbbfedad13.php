<?php

/* disaster-recovery/main.html */
class __TwigTemplate_4308ef0f56916ed4f3fcf08e7916953949f33989791c96561493f4cbbfedad13 extends Twig_Template
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
        echo "<div class=\"clear\"></div>
<div class=\"alert alert-danger\">
  This page is used to recover from database crashes that may happen over the course of this site's life. If you were to lose a massive amount of information or accidentally deleted records you didn't intend to delete, you can use this system to restore the data. For records you have changed on accident but the data record still exists, this will not revert the data back. You would still have to delete the record in question to recover the record using this system. It is recommended that you backup the database before using this option.
</div>
<div class=\"row\">
\t<div class=\"col-lg-12\">
\t\t<div class=\"panel panel-danger\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\">Recover Database</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t<label>Create a new backup?</label><br />
\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"BACKUP\" name=\"backupBtn\" id=\"backupBtn\">
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t<table id=\"backupTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t\t\t\t\t<thead>
\t                    \t<tr>
\t\t                        <th class=\"header\">Database <i class=\"fa fa-sort\"></i></th>
\t\t                        <th class=\"header\">Backup Date <i class=\"fa fa-sort\"></i></th>
\t\t                        <th class=\"header\"></th>
\t                      \t</tr>
                      \t</thead>
                      \t<tbody id=\"backup_entries\">
          \t\t\t\t\t";
        // line 30
        $this->env->loadTemplate("disaster-recovery/backup-entry.html")->display($context);
        // line 31
        echo "          \t\t\t\t</tbody>
             \t \t</table>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "disaster-recovery/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 31,  59 => 30,  31 => 4,  28 => 3,);
    }
}
