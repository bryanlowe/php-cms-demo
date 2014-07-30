<?php

/* create-invoice/invoice-entry.html */
class __TwigTemplate_51f9224fba0cde285a33c91acac6a6526f921a377b32ae600c42590a75e54fec extends Twig_Template
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
        if ((isset($context["INVOICE_ENTRIES"]) ? $context["INVOICE_ENTRIES"] : null)) {
            // line 2
            echo "\t<h2 align=\"center\">Period: ";
            echo (isset($context["START_DATE"]) ? $context["START_DATE"] : null);
            echo " to ";
            echo (isset($context["END_DATE"]) ? $context["END_DATE"] : null);
            echo "</h2>
\t<table id=\"invoiceTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t<thead>
\t    \t<tr>
\t            <th class=\"header\">Project Title <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Work Description <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Date <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Hours <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Rate <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Total <i class=\"fa fa-sort\"></i></th>
\t      \t</tr>
\t  \t</thead>
\t  \t<tbody id=\"invoice_entries\">
\t\t";
            // line 15
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["INVOICE_ENTRIES"]) ? $context["INVOICE_ENTRIES"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 16
                echo "\t\t\t<tr>
\t\t\t\t<td>";
                // line 17
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "project_title");
                echo "</td>
\t\t\t\t<td>";
                // line 18
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_hours"), "description");
                echo "</td>
\t\t\t\t<td align=\"right\">";
                // line 19
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_hours"), "date");
                echo "</td>
\t\t\t\t<td align=\"right\">";
                // line 20
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_hours"), "hours");
                echo "</td>
\t\t\t\t<td align=\"right\">\$";
                // line 21
                echo (isset($context["WRITER_RATE"]) ? $context["WRITER_RATE"] : null);
                echo "</td>
\t\t\t\t<td align=\"right\">\$";
                // line 22
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "total_pay");
                echo "</td>
\t\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "\t\t</tbody>
    </table>
    <p align=\"right\"><strong>Total Due: \$";
            // line 27
            echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
            echo "</strong></p>
    <script type=\"text/javascript\">
    <!--
    \tinvoice_attrs = [
    \t\t";
            // line 31
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["INVOICE_ENTRIES"]) ? $context["INVOICE_ENTRIES"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 32
                echo "    \t\t\t{
    \t\t\t\tproject_id: '";
                // line 33
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "_id");
                echo "',
    \t\t\t\twork_id: '";
                // line 34
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_hours"), "work_id");
                echo "',
    \t\t\t\ttotal_due: '";
                // line 35
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "total_pay");
                echo "'
    \t\t\t}
    \t\t\t";
                // line 37
                if ((twig_template_get_attributes($this, (isset($context["loop"]) ? $context["loop"] : null), "last") != true)) {
                    // line 38
                    echo "    \t\t\t\t,
    \t\t\t";
                }
                // line 40
                echo "    \t\t";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "    \t];
    \tinvoice_total = '";
            // line 42
            echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
            echo "';
    //-->
    </script>
";
        } else {
            // line 46
            echo "\t<p align=\"center\">There are no active invoices to show.</p>
";
        }
    }

    public function getTemplateName()
    {
        return "create-invoice/invoice-entry.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 46,  143 => 42,  140 => 41,  126 => 40,  122 => 38,  120 => 37,  115 => 35,  111 => 34,  107 => 33,  104 => 32,  87 => 31,  80 => 27,  76 => 25,  67 => 22,  63 => 21,  59 => 20,  55 => 19,  51 => 18,  47 => 17,  44 => 16,  40 => 15,  21 => 2,  19 => 1,);
    }
}
