-- 04 mayo 2015

ALTER TABLE sucursales ADD COLUMN representante boolean;
ALTER TABLE sucursales ALTER COLUMN representante SET NOT NULL;
COMMENT ON COLUMN sucursales.representante IS 'Indica si la persona de contacto es o no representante legal';



ALTER TABLE sucursales ADD COLUMN accionista boolean;
ALTER TABLE sucursales ALTER COLUMN accionista SET NOT NULL;
COMMENT ON COLUMN sucursales.accionista IS 'Indica si el representante legal es un accionista';




ALTER TABLE denominaciones_comerciales DROP COLUMN documento_registrado_id;

create type tipo_denominacion as enum ('PERSONA NATURAL', 'FIRMA PERSONAL', 'COMPAÑIA ANONIMA', 'SOCIEDAD ANONIMA', 'COMANDITA', 'FUNDACION', 'ASOCIACION CIVIL', 'SOCIEDAD CIVIL', 'SOCIEDAD DE RESPONSABILIDAD LIMITADA','COMPAÑIA NOMBRE COLECTIVO','ORGANIZACION SOCIOPRODUCTIVA','COOPERATIVA','EMPRESA EXTRANJERA');

create type tipo_sub_denominacion as enum ('SOCIEDAD ANONIMA', 'SOCIEDAD ANONIMA DE CAPITAL AUTORIZADO', 'SOCIEDAD ANONIMA INSCRITA DE CAPITAL ABIERTO', 'COMANDITA SIMPLE', 'COMANDITA POR ACCIONES', 'FUNDACION DEL ESTADO (NACIONAL)', 'FUNDACION DEL ESTADO (ESTADAL)', 'FUNDACION DEL ESTADO (MUNICIPAL)', 'EMPRESA DE PROPIEDAD SOCIAL DIRECTA COMUNAL','EMPRESA DE PROPIEDAD SOCIAL INDIRECTA COMUNAL','UNIDAD PRODCUTIVA FAMILIAR','GRUPO DE INTERCAMBIO SOLIDARIO');


ALTER TABLE denominaciones_comerciales DROP COLUMN sys_denominacion_comercial_id;

ALTER TABLE denominaciones_comerciales DROP COLUMN sys_subdenominacion_comercial_id;

ALTER TABLE denominaciones_comerciales ADD COLUMN tipo_denominacion tipo_denominacion;
ALTER TABLE denominaciones_comerciales ALTER COLUMN tipo_denominacion SET NOT NULL;
COMMENT ON COLUMN denominaciones_comerciales.tipo_denominacion IS 'Tipo de denominacion';

ALTER TABLE denominaciones_comerciales ADD COLUMN tipo_subdenominacion tipo_sub_denominacion;
COMMENT ON COLUMN denominaciones_comerciales.tipo_subdenominacion IS 'Tipo de subdenominacion';

Alter type tipo_sub_denominacion ADD VALUE 'CON FINES DE LUCRO' BEFORE 'GRUPO DE INTERCAMBIO SOLIDARIO';

Alter type tipo_sub_denominacion ADD VALUE 'SIN FINES DE LUCRO' BEFORE 'CON FINES DE LUCRO';

Alter type tipo_sub_denominacion ADD VALUE 'CON DOMICILIO EN VENEZUELA' BEFORE 'SIN FINES DE LUCRO';

Alter type tipo_sub_denominacion ADD VALUE 'SIN DOMICILIO EN VENEZUELA' BEFORE 'CON DOMICILIO EN VENEZUELA';
Alter type tipo_sub_denominacion ADD VALUE 'UNIDAD PRODUCTIVA FAMILIAR' BEFORE 'SIN DOMICILIO EN VENEZUELA';

 ALTER TABLE denominaciones_comerciales DROP COLUMN fin_lucro;