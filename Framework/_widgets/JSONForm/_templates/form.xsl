<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" xsl:extension-element-prefixes="php">
<xsl:include href="input_lib.xsl" />                                                                    

<xsl:output method="html" indent="yes" omit-xml-declaration="yes" media-type="application/xhtml+xml" encoding="iso-8859-1"/>
   
<xsl:template match="/">   
  <form name="{$form_name}" id="{$form_name}">
    <xsl:call-template name='form_row'>
			<xsl:with-param name="form" select="form_config/form" />
			<xsl:with-param name="current_row" select="1" />
      <xsl:with-param name="max_rows" select="form_config/form/input[not(preceding-sibling::input/@order > @order or following-sibling::input/@order > @order)]/@order" />
		</xsl:call-template>
  </form>
</xsl:template>

<xsl:template name="form_row">
  <xsl:param name="form" />
  <xsl:param name="current_row" />
  <xsl:param name="max_rows" />
  <xsl:if test="$current_row &lt;= $max_rows">
    <xsl:for-each select="$form/input[@order=$current_row]">
      <xsl:variable name="field_label" select="@label"/>
      <xsl:variable name="field_name" select="@id"/>
      <xsl:variable name="field_id" select="@id"/>  
      <xsl:variable name="field_value" select="@value"/>
      <xsl:variable name="class" select="@class" />
      <xsl:variable name="required" select="@required" />
      <xsl:variable name="onblur" select="@onblur" />
      <xsl:variable name="onclick" select="@onclick" />
      <xsl:variable name="onchange" select="@onchange" />
      <xsl:variable name="onkeypress" select="@onkeypress" />
      <xsl:variable name="onkeyup" select="@onkeyup" />
      <xsl:variable name="onkeydown" select="@onkeydown" />
      <xsl:choose>
        <xsl:when test="@type='button'">
          <xsl:call-template name="button_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="onclick" select="$onclick" />
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='submit'">
          <xsl:call-template name="submit_input">
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="onclick" select="$onclick" />
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='email'">
          <xsl:call-template name="email_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onblur" select="$onblur" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="onchange" select="$onchange" />
            <xsl:with-param name="onkeypress" select="$onkeypress" />
            <xsl:with-param name="onkeyup" select="$onkeyup" />
            <xsl:with-param name="onkeydown" select="$onkeydown" />
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='number'">
          <xsl:call-template name="number_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onblur" select="$onblur" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="onchange" select="$onchange" />
            <xsl:with-param name="onkeypress" select="$onkeypress" />
            <xsl:with-param name="onkeyup" select="$onkeyup" />
            <xsl:with-param name="onkeydown" select="$onkeydown" />
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='text'">
          <xsl:call-template name="text_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onblur" select="$onblur" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="onchange" select="$onchange" />
            <xsl:with-param name="onkeypress" select="$onkeypress" />
            <xsl:with-param name="onkeyup" select="$onkeyup" />
            <xsl:with-param name="onkeydown" select="$onkeydown" /> 
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='password'">
          <xsl:call-template name="password_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onblur" select="$onblur" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="onchange" select="$onchange" />
            <xsl:with-param name="onkeypress" select="$onkeypress" />
            <xsl:with-param name="onkeyup" select="$onkeyup" />
            <xsl:with-param name="onkeydown" select="$onkeydown" /> 
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='hidden'">
          <xsl:call-template name="hidden_input">
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/>  
            <xsl:with-param name="field_value" select="$field_value" />
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='textarea'">
          <xsl:call-template name="textarea_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onblur" select="$onblur" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="onchange" select="$onchange" />
            <xsl:with-param name="onkeypress" select="$onkeypress" />
            <xsl:with-param name="onkeyup" select="$onkeyup" />
            <xsl:with-param name="onkeydown" select="$onkeydown" /> 
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='radio-h'">
          <xsl:call-template name="radio_horizontal_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="options" select="./options"/>
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='radio-v'">
          <xsl:call-template name="radio_vertical_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="options" select="./options"/>
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='checkbox-h'">
          <xsl:call-template name="checkbox_horizontal_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="options" select="./options"/>
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='checkbox-v'">
          <xsl:call-template name="checkbox_vertical_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onclick" select="$onclick" />
            <xsl:with-param name="options" select="./options"/>
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="@type='select'">
          <xsl:call-template name="select_input">
            <xsl:with-param name="field_label" select="$field_label"/>
            <xsl:with-param name="field_name" select="$field_name"/>
            <xsl:with-param name="field_id" select="$field_id"/> 
            <xsl:with-param name="field_value" select="$field_value" />
            <xsl:with-param name="class" select="$class" />
            <xsl:with-param name="required" select="$required" />
            <xsl:with-param name="onchange" select="$onchange" />
            <xsl:with-param name="options" select="./options"/>
          </xsl:call-template>
        </xsl:when>
      </xsl:choose>  
    </xsl:for-each>
    
    <xsl:call-template name="line_break" />
    
    <xsl:call-template name="form_row">
      <xsl:with-param name="form" select="$form"/>
      <xsl:with-param name="current_row" select="$current_row + 1"/>
      <xsl:with-param name="max_rows" select="$max_rows"/>
    </xsl:call-template>
  </xsl:if>
</xsl:template>

</xsl:stylesheet>