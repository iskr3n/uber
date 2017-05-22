<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="2.0"
      xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
<xsl:template match="/">
		<html><head>LUGARES</head>
		<body>
		<ul>
			<xsl:apply-templates select="//lugares" />
		</ul>
		</body>
		</html>
	</xsl:template>
	
	<xsl:template match="lugar">
		<li /><b><xsl:value-of select="direccion" />:</b> 
			(<xsl:value-of select="localidad" />)
	</xsl:template>
</xsl:stylesheet>
