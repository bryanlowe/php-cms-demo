<?php

/* disaster-recovery/backup-entry.html */
class __TwigTemplate_d6d0135b39a5c71168e3ab9e7b727bce161b5ccf2aa290a5e6bc9543ca200ea5 extends Twig_Template
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
        if ((isset($context["BACKUP_ENTRIES"]) ? $context["BACKUP_ENTRIES"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["BACKUP_ENTRIES"]) ? $context["BACKUP_ENTRIES"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["backup"]) {
                // line 3
                echo "\t\t<tr>
\t\t\t<td>";
                // line 4
                echo twig_template_get_attributes($this, (isset($context["backup"]) ? $context["backup"] : null), "database");
                echo "</td>
\t\t\t<td>";
                // line 5
                echo twig_template_get_attributes($this, (isset($context["backup"]) ? $context["backup"] : null), "date");
                echo "</td>
\t\t\t<td align=\"center\"><input type=\"button\" class=\"btn btn-success\" value=\"RECOVER\" onclick=\"restoreDatabase('";
                // line 6
                echo twig_template_get_attributes($this, (isset($context["backup"]) ? $context["backup"] : null), "database");
                echo "','";
                echo twig_template_get_attributes($this, (isset($context["backup"]) ? $context["backup"] : null), "timestamp");
                echo "');\" /></td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['backup'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 10
            echo "<tr><td colspan=\"3\"><p align=\"center\">There are no active backups to show.</p></td></tr>
";
        }
    }

    public function getTemplateName()
    {
        return "disaster-recovery/backup-entry.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 10,  37 => 6,  33 => 5,  29 => 4,  26 => 3,  21 => 2,  19 => 1,  60 => 30,  58 => 29,  31 => 4,  28 => 3,);
    }
}
