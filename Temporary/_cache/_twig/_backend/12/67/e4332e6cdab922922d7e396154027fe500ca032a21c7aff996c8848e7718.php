<?php

/* client-resources/list-group-item.html */
class __TwigTemplate_1267e4332e6cdab922922d7e396154027fe500ca032a21c7aff996c8848e7718 extends Twig_Template
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
        if ((isset($context["RESOURCE_LIST"]) ? $context["RESOURCE_LIST"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["RESOURCE_LIST"]) ? $context["RESOURCE_LIST"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["resource"]) {
                // line 3
                echo "\t    <div class=\"list-group-item\"><a href=\"/Media/_documents/_clients/";
                echo (isset($context["CLIENT_ID"]) ? $context["CLIENT_ID"] : null);
                echo "/";
                echo (isset($context["resource"]) ? $context["resource"] : null);
                echo "\" target=\"_blank\">File: ";
                echo (isset($context["resource"]) ? $context["resource"] : null);
                echo "</a> <button class=\"close\" type=\"button\" onclick=\"removeResource('";
                echo (isset($context["resource"]) ? $context["resource"] : null);
                echo "');\">×</button></div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['resource'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 6
            echo "\t<p align=\"center\">No Files Found</p>
";
        }
    }

    public function getTemplateName()
    {
        return "client-resources/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 6,  26 => 3,  21 => 2,  19 => 1,);
    }
}
