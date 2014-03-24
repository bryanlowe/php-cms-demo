<?php

/* projects/list-group-item.html */
class __TwigTemplate_85abff4ca2d0a6146744706f5c920df5469cb02d86c241469ac28374cccb36ed extends Twig_Template
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
        if ((twig_length_filter($this->env, (isset($context["PROJECT_TIMELINE"]) ? $context["PROJECT_TIMELINE"] : null)) > 0)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["PROJECT_TIMELINE"]) ? $context["PROJECT_TIMELINE"] : null));
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
                // line 3
                echo "\t    <span><a href=\"javascript:;\" class=\"list-group-item\" onclick=\"\$('#timeline-desc').html(\$('#event_";
                echo twig_template_get_attributes($this, (isset($context["loop"]) ? $context["loop"] : null), "index");
                echo "').html());\">Timeline Event: ";
                echo twig_template_get_attributes($this, (isset($context["event"]) ? $context["event"] : null), "date");
                echo "</a></span>
\t    <div id=\"event_";
                // line 4
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
            // line 7
            echo "\t<p align=\"center\">No current timeline events</p>
";
        }
    }

    public function getTemplateName()
    {
        return "projects/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 7,  46 => 4,  39 => 3,  21 => 2,  19 => 1,);
    }
}
