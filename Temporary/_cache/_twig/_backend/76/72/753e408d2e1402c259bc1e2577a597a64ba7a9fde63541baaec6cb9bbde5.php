<?php

/* invoices/list-group-item.html */
class __TwigTemplate_7672753e408d2e1402c259bc1e2577a597a64ba7a9fde63541baaec6cb9bbde5 extends Twig_Template
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
        if ((twig_length_filter($this->env, (isset($context["INVOICE_HISTORY"]) ? $context["INVOICE_HISTORY"] : null)) > 0)) {
            // line 2
            echo "\t<label>Status Timeline</label>
\t";
            // line 3
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["INVOICE_HISTORY"]) ? $context["INVOICE_HISTORY"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
                // line 4
                echo "\t\t<script type=\"text/javascript\">
\t\t<!--
\t\t\tvar timeline_";
                // line 6
                echo twig_template_get_attributes($this, (isset($context["loop"]) ? $context["loop"] : null), "index");
                echo " = {description: '";
                echo twig_template_get_attributes($this, (isset($context["event"]) ? $context["event"] : null), "description");
                echo "', date: '";
                echo twig_template_get_attributes($this, (isset($context["event"]) ? $context["event"] : null), "date");
                echo "' };
\t\t//-->
\t\t</script>
\t    <div class=\"list-group-item\"><a href=\"javascript:;\" onclick=\"\$('#status-desc').html(\$('#event_";
                // line 9
                echo twig_template_get_attributes($this, (isset($context["loop"]) ? $context["loop"] : null), "index");
                echo "').html());\">Status on Date: ";
                echo twig_template_get_attributes($this, (isset($context["event"]) ? $context["event"] : null), "date");
                echo "</a> <button class=\"close\" type=\"button\" onclick=\"removeEvent(timeline_";
                echo twig_template_get_attributes($this, (isset($context["loop"]) ? $context["loop"] : null), "index");
                echo ");\">×</button></div>
\t    <div id=\"event_";
                // line 10
                echo twig_template_get_attributes($this, (isset($context["loop"]) ? $context["loop"] : null), "index");
                echo "\" style=\"display:none;\">";
                echo twig_template_get_attributes($this, (isset($context["event"]) ? $context["event"] : null), "description");
                echo "</div>
\t";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 13
            echo "\t<label>Status Timeline</label>
\t<div class=\"list-group-item\">No current invoice status</div>
";
        }
    }

    public function getTemplateName()
    {
        return "invoices/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 13,  63 => 10,  55 => 9,  45 => 6,  41 => 4,  24 => 3,  21 => 2,  19 => 1,  122 => 75,  118 => 74,  109 => 67,  107 => 66,  93 => 54,  91 => 53,  54 => 19,  50 => 17,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
