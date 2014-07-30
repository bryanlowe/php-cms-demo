<?php

/* home/main.html */
class __TwigTemplate_4c816c45f9a60e41a1e6a96df2c5162a07fba7ebb19382f3e5718370660958d4 extends Twig_Template
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
        echo "<div class=\"container\">
\t<div class=\"row task-panel\">
\t\t<!-- Feedback Block -->
\t\t<div class=\"col-lg-3 col-lg-offset-3\">
        <div id=\"feedback-container\" class=\"panel panel-success\">
          \t<div class=\"panel-heading\">
            \t<div class=\"row\">
                \t<div class=\"col-xs-6\">
                  \t<i class=\"fa fa-comment fa-5x\"></i>
                \t</div>
                \t<div id=\"feedback-title\" class=\"col-xs-6 text-right\">
                  \t  <p class=\"task-title\">Feedback</p>
                \t</div>
            \t</div>
          \t</div>
          \t<a href=\"";
        // line 19
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/feedback\">
            \t<div class=\"panel-footer announcement-bottom\">
                \t<div class=\"row\">
                  \t<div class=\"col-xs-8\">
                   \t\tSubmit Feedback
                  \t</div>
                  \t<div class=\"col-xs-4 text-right\">
                    \t\t<i class=\"fa fa-arrow-circle-right\"></i>
                  \t</div>
                \t</div>
            \t</div>
          \t</a>
        </div>
    </div>
    <!-- End Feedback Block -->

    <!-- Order Block -->
    <div class=\"col-lg-3\">
      <div id=\"order-container\" class=\"panel panel-success\">
        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-pencil-square fa-5x\"></i>
            </div>
            <div id=\"order-title\" class=\"col-xs-6 text-right\">
                <p class=\"task-title\">Orders</p>
            </div>
          </div>
        </div>
        <a href=\"";
        // line 48
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/orders\">
          <div class=\"panel-footer announcement-bottom\">
            <div class=\"row\">
              <div class=\"col-xs-8\">
                Place an Order
              </div>
              <div class=\"col-xs-4 text-right\">
                <i class=\"fa fa-arrow-circle-right\"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Order Block -->
\t</div>
\t<div class=\"row\">
    <!-- Invoice Block -->
    <div class=\"col-lg-3 col-lg-offset-1\" style=\"margin-left: 135px;\">
      <div class=\"panel panel-success\">
        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-envelope fa-5x\"></i>
            </div>
            <div class=\"col-xs-6 text-right\">
              <p class=\"task-title\">Invoices</p>
            </div>
          </div>
        </div>
        <a href=\"";
        // line 78
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/invoices\">
          <div class=\"panel-footer announcement-bottom\">
            <div class=\"row\">
              <div class=\"col-xs-9\">
                View Invoice History
              </div>
              <div class=\"col-xs-3 text-right\">
                <i class=\"fa fa-arrow-circle-right\"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Invoice Block -->

    <!-- Project Block -->
    <div class=\"col-lg-3\">
        <div class=\"panel panel-success\">
            <div class=\"panel-heading\">
              <div class=\"row\">
                  <div class=\"col-xs-6\">
                    <i class=\"fa fa-tasks fa-5x\"></i>
                  </div>
                  <div class=\"col-xs-6 text-right\">
                    <p class=\"task-title\">Projects</p>
                  </div>
              </div>
            </div>
            <a href=\"";
        // line 107
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/projects\">
              <div class=\"panel-footer announcement-bottom\">
                  <div class=\"row\">
                    <div class=\"col-xs-9\">
                      View Project Details
                    </div>
                    <div class=\"col-xs-3 text-right\">
                        <i class=\"fa fa-arrow-circle-right\"></i>
                    </div>
                  </div>
              </div>
            </a>
        </div>
    </div>
    <!-- End Project Block -->

    <!-- Account Block -->
    <div class=\"col-lg-3\">
      <div class=\"panel panel-success\">
        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-users fa-5x\"></i>
            </div>
            <div class=\"col-xs-6 text-right\">
              <p class=\"task-title\">Account</p>
            </div>
          </div>
        </div>
        <a href=\"";
        // line 136
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/account\">
          <div class=\"panel-footer announcement-bottom\">
            <div class=\"row\">
              <div class=\"col-xs-6\">
                Edit Account
              </div>
              <div class=\"col-xs-6 text-right\">
                <i class=\"fa fa-arrow-circle-right\"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Account Block -->
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "home/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  177 => 136,  145 => 107,  113 => 78,  80 => 48,  48 => 19,  31 => 4,  28 => 3,);
    }
}
