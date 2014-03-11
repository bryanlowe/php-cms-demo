<?php

/* feedback/main.html */
class __TwigTemplate_65c43a4f09c4d130021ba1b8f840ede2f946775f1da14b4f80cd4bd5941f8ba3 extends Twig_Template
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
        echo "<div class=\"row\">
\t<div class=\"col-lg-6\">
\t\t<div class=\"panel panel-primary\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\">Recently Added Feedback</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<div id=\"feedback-recent\" class=\"list-group\">
\t\t\t\t\t";
        // line 12
        if ((isset($context["RECENT_POSTS"]) ? $context["RECENT_POSTS"] : null)) {
            // line 13
            echo "\t\t\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["RECENT_POSTS"]) ? $context["RECENT_POSTS"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 14
                echo "\t\t\t\t\t\t    ";
                $this->env->loadTemplate("feedback/list-group-item.html")->display($context);
                // line 15
                echo "\t\t\t\t\t\t";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "\t\t\t\t\t";
        } else {
            // line 17
            echo "\t\t\t\t\t<h2 class=\"no-entries\" align=\"center\">No feedback to show</h2>
\t\t\t\t\t";
        }
        // line 19
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"col-lg-6\">
\t\t<div class=\"panel panel-primary\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\">Past Feedback</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<div id=\"feedback-past\" class=\"list-group\">
\t\t\t\t\t";
        // line 30
        if ((isset($context["PAST_POSTS"]) ? $context["PAST_POSTS"] : null)) {
            // line 31
            echo "\t\t\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["PAST_POSTS"]) ? $context["PAST_POSTS"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 32
                echo "\t\t\t\t\t\t    ";
                $this->env->loadTemplate("feedback/list-group-item.html")->display($context);
                // line 33
                echo "\t\t\t\t\t\t";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "\t\t\t\t\t";
        } else {
            // line 35
            echo "\t\t\t\t\t<h2 class=\"no-entries\" align=\"center\">No feedback to show</h2>
\t\t\t\t\t";
        }
        // line 37
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
<div class=\"row\">
\t<div class=\"col-lg-12\">
\t\t<div class=\"panel panel-primary\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\">Feedback Details</h3>
\t\t\t</div>
\t\t\t<div id=\"feedback-details\" class=\"panel-body\"><h2 class=\"no-entries\" align=\"center\">No details to show</h2></div>
\t\t</div>
\t</div>
</div>
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
        return array (  142 => 37,  138 => 35,  135 => 34,  121 => 33,  118 => 32,  100 => 31,  98 => 30,  85 => 19,  81 => 17,  78 => 16,  64 => 15,  61 => 14,  43 => 13,  41 => 12,  31 => 4,  28 => 3,);
    }
}
