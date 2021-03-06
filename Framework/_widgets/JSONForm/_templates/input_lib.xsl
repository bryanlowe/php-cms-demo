<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template name="line_break">
    <div class="clear"></div>
  </xsl:template>

  <xsl:template name="input_label">
    <xsl:param name="field_label" />
    <xsl:param name="field_name" />
    <xsl:choose>
      <xsl:when test="$field_label != ''">
  			<label for="{$field_name}"><xsl:value-of select="$field_label"/></label><br />
  		</xsl:when>
  		<xsl:otherwise>
  			<br />
  		</xsl:otherwise>
    </xsl:choose>
  </xsl:template>
  
  <xsl:template name="text_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onblur" />
    <xsl:param name="onclick" />
    <xsl:param name="onchange" />
    <xsl:param name="onkeypress" />
    <xsl:param name="onkeyup" />
    <xsl:param name="onkeydown" />
  	<xsl:param name="field_label" />
  	<xsl:param name="field_name" />
  	<xsl:param name="field_id" />
  	<xsl:param name="field_value" />
  	<div id="{$field_id}_container" class="input_container">
  	    <xsl:call-template name="input_label">
  				<xsl:with-param name="field_label" select="$field_label" />
  				<xsl:with-param name="field_name" select="$field_name" />
  			</xsl:call-template>
        <input id="{$field_id}" name="{$field_name}" type="text" value="{$field_value}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$required != ''">
            <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onblur != ''">
            <xsl:attribute name="onblur"><xsl:value-of select="$onblur" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onclick != ''">
            <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onchange != ''">
            <xsl:attribute name="onchange"><xsl:value-of select="$onchange" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeypress != ''">
            <xsl:attribute name="onkeypress"><xsl:value-of select="$onkeypress" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeyup != ''">
            <xsl:attribute name="onkeyup"><xsl:value-of select="$onkeyup" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeydown != ''">
            <xsl:attribute name="onkeydown"><xsl:value-of select="$onkeydown" /></xsl:attribute>
          </xsl:if>
        </input>
    </div>
  </xsl:template>

  <xsl:template name="email_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onblur" />
    <xsl:param name="onclick" />
    <xsl:param name="onchange" />
    <xsl:param name="onkeypress" />
    <xsl:param name="onkeyup" />
    <xsl:param name="onkeydown" />
    <xsl:param name="field_label" />
    <xsl:param name="field_name" />
    <xsl:param name="field_id" />
    <xsl:param name="field_value" />
    <div id="{$field_id}_container" class="input_container">
        <xsl:call-template name="input_label">
          <xsl:with-param name="field_label" select="$field_label" />
          <xsl:with-param name="field_name" select="$field_name" />
        </xsl:call-template>
        <input id="{$field_id}" name="{$field_name}" type="email" value="{$field_value}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$required != ''">
            <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onblur != ''">
            <xsl:attribute name="onblur"><xsl:value-of select="$onblur" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onclick != ''">
            <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onchange != ''">
            <xsl:attribute name="onchange"><xsl:value-of select="$onchange" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeypress != ''">
            <xsl:attribute name="onkeypress"><xsl:value-of select="$onkeypress" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeyup != ''">
            <xsl:attribute name="onkeyup"><xsl:value-of select="$onkeyup" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeydown != ''">
            <xsl:attribute name="onkeydown"><xsl:value-of select="$onkeydown" /></xsl:attribute>
          </xsl:if>
        </input>
    </div>
  </xsl:template>

  <xsl:template name="number_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onblur" />
    <xsl:param name="onclick" />
    <xsl:param name="onchange" />
    <xsl:param name="onkeypress" />
    <xsl:param name="onkeyup" />
    <xsl:param name="onkeydown" />
    <xsl:param name="field_label" />
    <xsl:param name="field_name" />
    <xsl:param name="field_id" />
    <xsl:param name="field_value" />
    <div id="{$field_id}_container" class="input_container">
        <xsl:call-template name="input_label">
          <xsl:with-param name="field_label" select="$field_label" />
          <xsl:with-param name="field_name" select="$field_name" />
        </xsl:call-template>
        <input id="{$field_id}" name="{$field_name}" type="number" value="{$field_value}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$required != ''">
            <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onblur != ''">
            <xsl:attribute name="onblur"><xsl:value-of select="$onblur" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onclick != ''">
            <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onchange != ''">
            <xsl:attribute name="onchange"><xsl:value-of select="$onchange" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeypress != ''">
            <xsl:attribute name="onkeypress"><xsl:value-of select="$onkeypress" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeyup != ''">
            <xsl:attribute name="onkeyup"><xsl:value-of select="$onkeyup" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeydown != ''">
            <xsl:attribute name="onkeydown"><xsl:value-of select="$onkeydown" /></xsl:attribute>
          </xsl:if>
        </input>
    </div>
  </xsl:template>
  
  <xsl:template name="password_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onblur" />
    <xsl:param name="onclick" />
    <xsl:param name="onchange" />
    <xsl:param name="onkeypress" />
    <xsl:param name="onkeyup" />
    <xsl:param name="onkeydown" />
  	<xsl:param name="field_label" />
  	<xsl:param name="field_name" />
  	<xsl:param name="field_id" />
  	<xsl:param name="field_value" />
  	<div id="{$field_id}_container" class="input_container">
  	    <xsl:call-template name="input_label">
  				<xsl:with-param name="field_label" select="$field_label" />
  			</xsl:call-template>
        <input id="{$field_id}" name="{$field_name}" type="password" value="{$field_value}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$required != ''">
            <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onblur != ''">
            <xsl:attribute name="onblur"><xsl:value-of select="$onblur" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onclick != ''">
            <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onchange != ''">
            <xsl:attribute name="onchange"><xsl:value-of select="$onchange" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeypress != ''">
            <xsl:attribute name="onkeypress"><xsl:value-of select="$onkeypress" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeyup != ''">
            <xsl:attribute name="onkeyup"><xsl:value-of select="$onkeyup" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeydown != ''">
            <xsl:attribute name="onkeydown"><xsl:value-of select="$onkeydown" /></xsl:attribute>
          </xsl:if>
        </input>
    </div>
  </xsl:template>
  
  <xsl:template name="hidden_input">
    <xsl:param name="class" />
  	<xsl:param name="field_name" />
  	<xsl:param name="field_id" />
  	<xsl:param name="field_value" />
    <input id="{$field_id}" name="{$field_name}" type="hidden" value="{$field_value}">
      <xsl:if test="$class != ''">
        <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
      </xsl:if>
    </input>
  </xsl:template>
  
  <xsl:template name="textarea_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onblur" />
    <xsl:param name="onclick" />
    <xsl:param name="onchange" />
    <xsl:param name="onkeypress" />
    <xsl:param name="onkeyup" />
    <xsl:param name="onkeydown" />
  	<xsl:param name="field_label" />
  	<xsl:param name="field_name" />
  	<xsl:param name="field_id" />
  	<xsl:param name="field_value" />
  	<div id="{$field_id}_container" class="input_container">
  	    <xsl:call-template name="input_label">
  				<xsl:with-param name="field_label" select="$field_label" />
  			</xsl:call-template>
  			<textarea id="{$field_id}" name="{$field_name}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$required != ''">
            <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onblur != ''">
            <xsl:attribute name="onblur"><xsl:value-of select="$onblur" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onclick != ''">
            <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onchange != ''">
            <xsl:attribute name="onchange"><xsl:value-of select="$onchange" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeypress != ''">
            <xsl:attribute name="onkeypress"><xsl:value-of select="$onkeypress" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeyup != ''">
            <xsl:attribute name="onkeyup"><xsl:value-of select="$onkeyup" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onkeydown != ''">
            <xsl:attribute name="onkeydown"><xsl:value-of select="$onkeydown" /></xsl:attribute>
          </xsl:if>
        <xsl:value-of select="$field_value" /></textarea>
    </div>
  </xsl:template>
  
  <xsl:template name="radio_vertical_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onclick" />
  	<xsl:param name="field_label" />
  	<xsl:param name="field_name" />
  	<xsl:param name="field_id" />
  	<xsl:param name="options" />
  	<xsl:param name="field_value" />
  	<div id="{$field_id}_container" class="input_container form-group">
  	    <xsl:call-template name="input_label">
  				<xsl:with-param name="field_label" select="$field_label" />
  			</xsl:call-template>
  			<xsl:for-each select="$options/option">
  			  <xsl:choose>
    			  <xsl:when test="contains($field_value,value)">
    			    <div class="radio">
                <label>
                  <input id="{$field_name}_{position()}" name="{$field_name}" type="radio" value="{value}" checked="true">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> 
                  <xsl:value-of select="name" />
                </label>
              </div>
        		</xsl:when>
        		<xsl:otherwise>
              <div class="radio">
                <label>
            			<input id="{$field_name}_{position()}" name="{$field_name}" type="radio" value="{value}">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> 
                  <xsl:value-of select="name" />
                </label>
              </div>
        		</xsl:otherwise>
          </xsl:choose> 
  			</xsl:for-each>
    </div>
  </xsl:template>

  <xsl:template name="radio_horizontal_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onclick" />
    <xsl:param name="field_label" />
    <xsl:param name="field_name" />
    <xsl:param name="field_id" />
    <xsl:param name="options" />
    <xsl:param name="field_value" />
    <div id="{$field_id}_container" class="input_container form-group">
        <xsl:call-template name="input_label">
          <xsl:with-param name="field_label" select="$field_label" />
        </xsl:call-template>
        <xsl:for-each select="$options/option">
          <xsl:choose>
            <xsl:when test="contains($field_value,value)">
              <div class="radio-inline">
                <label>
                  <input id="{$field_name}_{position()}" name="{$field_name}" type="radio" value="{value}" checked="true">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> 
                  <xsl:value-of select="name" />
                </label>
              </div>
            </xsl:when>
            <xsl:otherwise>
              <div class="radio-inline">
                <label>
                  <input id="{$field_name}_{position()}" name="{$field_name}" type="radio" value="{value}">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> 
                  <xsl:value-of select="name" />
                </label>
              </div>
            </xsl:otherwise>
          </xsl:choose> 
        </xsl:for-each>
    </div>
  </xsl:template>
  
  <xsl:template name="checkbox_vertical_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onclick" />
  	<xsl:param name="field_label" />
  	<xsl:param name="field_name" />
  	<xsl:param name="field_id" />
  	<xsl:param name="options" />
  	<xsl:param name="field_value" />
  	<div id="{$field_id}_container" class="input_container form-group">
  	    <xsl:call-template name="input_label">
  				<xsl:with-param name="field_label" select="$field_label" />
  			</xsl:call-template>
  			<xsl:for-each select="$options/option">
  			  <xsl:choose>
    			  <xsl:when test="contains($field_value,value)">
              <div class="checkbox">
                <label>
        			    <input id="{$field_name}_{position()}" name="{$field_name}" type="checkbox" value="{value}" checked="true">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> 
                  <xsl:value-of select="name" />
                </label>
              </div>
        		</xsl:when>
        		<xsl:otherwise>
              <div class="checkbox">
                <label>
            			<input id="{$field_name}_{position()}" name="{$field_name}" type="checkbox" value="{value}">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> <xsl:value-of select="name" />
                </label>
              </div>
        		</xsl:otherwise>
          </xsl:choose> 
  			</xsl:for-each>
    </div>
  </xsl:template>

  <xsl:template name="checkbox_horizontal_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onclick" />
    <xsl:param name="field_label" />
    <xsl:param name="field_name" />
    <xsl:param name="field_id" />
    <xsl:param name="options" />
    <xsl:param name="field_value" />
    <div id="{$field_id}_container" class="input_container form-group">
        <xsl:call-template name="input_label">
          <xsl:with-param name="field_label" select="$field_label" />
        </xsl:call-template>
        <xsl:for-each select="$options/option">
          <xsl:choose>
            <xsl:when test="contains($field_value,value)">
              <div class="checkbox-inline">
                <label>
                  <input id="{$field_name}_{position()}" name="{$field_name}" type="checkbox" value="{value}" checked="true">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> 
                  <xsl:value-of select="name" />
                </label>
              </div>
            </xsl:when>
            <xsl:otherwise>
              <div class="checkbox-inline">
                <label>
                  <input id="{$field_name}_{position()}" name="{$field_name}" type="checkbox" value="{value}">
                    <xsl:if test="$class != ''">
                      <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$required != ''">
                      <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
                    </xsl:if>
                    <xsl:if test="$onclick != ''">
                      <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
                    </xsl:if>
                  </input> <xsl:value-of select="name" />
                </label>
              </div>
            </xsl:otherwise>
          </xsl:choose> 
        </xsl:for-each>
    </div>
  </xsl:template>
  
  <xsl:template name="select_input">
    <xsl:param name="class" />
    <xsl:param name="required" />
    <xsl:param name="onchange" />
    <xsl:param name="options" />
    <xsl:param name="field_value" />
  	<xsl:param name="field_label" />
  	<xsl:param name="field_name" />
  	<xsl:param name="field_id" />
  	<div id="{$field_id}_container" class="input_container">
  	    <xsl:call-template name="input_label">
  				<xsl:with-param name="field_label" select="$field_label" />
          <xsl:with-param name="field_name" select="$field_name" />
  			</xsl:call-template>
        <select id="{$field_id}" name="{$field_name}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$required != ''">
            <xsl:attribute name="required"><xsl:value-of select="$required" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onchange != ''">
            <xsl:attribute name="onchange"><xsl:value-of select="$onchange" /></xsl:attribute> 
          </xsl:if>
    			<xsl:for-each select="$options/option">
            <xsl:choose>
              <xsl:when test="contains($field_value,value)">
                <option value="{value}">
                  <xsl:attribute name="selected"><xsl:value-of select="boolean('true')" /></xsl:attribute>
                  <xsl:value-of select="name" />
                </option>
              </xsl:when>
              <xsl:otherwise>
                <option value="{value}"><xsl:value-of select="name" /></option>
              </xsl:otherwise>
            </xsl:choose> 
          </xsl:for-each>
        </select>
    </div>
  </xsl:template>  

  <xsl:template name="button_input">
    <xsl:param name="class" />
    <xsl:param name="onclick" />
    <xsl:param name="field_label" />
    <xsl:param name="field_name" />
    <xsl:param name="field_id" />
    <xsl:param name="field_value" />
    <div id="{$field_id}_container" class="input_container">
        <xsl:call-template name="input_label">
          <xsl:with-param name="field_label" select="$field_label" />
          <xsl:with-param name="field_name" select="$field_name" />
        </xsl:call-template>
        <input id="{$field_id}" name="{$field_name}" type="button" value="{$field_value}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onclick != ''">
            <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
          </xsl:if>
        </input>
    </div>
  </xsl:template>

  <xsl:template name="submit_input">
    <xsl:param name="class" />
    <xsl:param name="onclick" />
    <xsl:param name="field_name" />
    <xsl:param name="field_id" />
    <xsl:param name="field_value" />
    <div id="{$field_id}_container" class="input_container">
        <input id="{$field_id}" name="{$field_name}" type="submit" value="{$field_value}">
          <xsl:if test="$class != ''">
            <xsl:attribute name="class"><xsl:value-of select="$class" /></xsl:attribute> 
          </xsl:if>
          <xsl:if test="$onclick != ''">
            <xsl:attribute name="onclick"><xsl:value-of select="$onclick" /></xsl:attribute> 
          </xsl:if>
        </input>
    </div>
  </xsl:template>
</xsl:stylesheet>