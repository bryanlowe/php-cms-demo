<?php

/* orders/main.html */
class __TwigTemplate_1e2bdf840123c1e9a59983a6475bd12dc41a4447823a97c7c10b57c6a91d6b95 extends Twig_Template
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
        echo "<div class=\"row task-panel\">
\t<div class=\"col-lg-6\">
\t\t<div class=\"panel panel-primary\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\">Recently Added Orders</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<div id=\"order-recent\" class=\"list-group\">
\t\t\t\t\t";
        // line 12
        if ((isset($context["RECENT_ORDERS"]) ? $context["RECENT_ORDERS"] : null)) {
            // line 13
            echo "\t\t\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["RECENT_ORDERS"]) ? $context["RECENT_ORDERS"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 14
                echo "\t\t\t\t\t\t    ";
                $this->env->loadTemplate("orders/list-group-item.html")->display($context);
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "\t\t\t\t\t";
        } else {
            // line 17
            echo "\t\t\t\t\t<h2 class=\"no-entries\" align=\"center\">No orders to show</h2>
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
\t\t\t\t<h3 class=\"panel-title\">Past Orders</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<div id=\"order-past\" class=\"list-group\">
\t\t\t\t\t";
        // line 30
        if ((isset($context["PAST_ORDERS"]) ? $context["PAST_ORDERS"] : null)) {
            // line 31
            echo "\t\t\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["PAST_ORDERS"]) ? $context["PAST_ORDERS"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 32
                echo "\t\t\t\t\t\t    ";
                $this->env->loadTemplate("orders/list-group-item.html")->display($context);
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "\t\t\t\t\t";
        } else {
            // line 35
            echo "\t\t\t\t\t<h2 class=\"no-entries\" align=\"center\">No orders to show</h2>
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
\t\t\t\t<h3 class=\"panel-title\">Order Details</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<div id=\"create_project\">
\t\t\t\t\t<div class=\"input_container\">
\t\t\t\t\t\t<label>Create a title to save this as a project (The order will be removed from this page when saved)</label><br />
\t\t\t\t\t\t<input type=\"text\" id=\"project_title\" name=\"project_title\" value=\"\" class=\"form-control\" />
\t\t\t\t\t\t<input type=\"hidden\" id=\"order_id\" name=\"order_id\" value=\"\" />
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"CREATE PROJECT\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div id=\"order-details\"><h2 class=\"no-entries\" align=\"center\">No details to show</h2></div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "orders/main.html";
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
