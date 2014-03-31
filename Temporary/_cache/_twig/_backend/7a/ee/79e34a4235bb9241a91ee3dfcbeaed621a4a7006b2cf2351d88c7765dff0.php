<?php

/* clients/list-group-item.html */
class __TwigTemplate_7aee79e34a4235bb9241a91ee3dfcbeaed621a4a7006b2cf2351d88c7765dff0 extends Twig_Template
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
        if ((isset($context["PROJECT_TAGS"]) ? $context["PROJECT_TAGS"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["PROJECT_TAGS"]) ? $context["PROJECT_TAGS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 3
                echo "\t    <div class=\"list-group-item\">Tag: ";
                echo (isset($context["tag"]) ? $context["tag"] : null);
                echo " <button class=\"close\" type=\"button\" onclick=\"removeProjectTag('";
                echo (isset($context["tag"]) ? $context["tag"] : null);
                echo "');\">×</button></div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 6
            echo "\t<p align=\"center\">No tags</p>
";
        }
    }

    public function getTemplateName()
    {
        return "clients/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  26 => 3,  21 => 2,  19 => 1,);
    }
}
