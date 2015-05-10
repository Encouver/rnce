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





DROP TABLE sys_subdenominaciones_comerciales;
DROP TABLE sys_denominaciones_comerciales;


-- mayo 06 2015

ALTER TABLE objetos_empresas DROP COLUMN nombre;
DROP TYPE objeto_empresa;
ALTER TABLE objetos_empresas DROP COLUMN autorizacion;
ALTER TABLE objetos_empresas RENAME COLUMN tipo_relacion to contratista;
ALTER TABLE objetos_empresas RENAME COLUMN relacion_id to empresa_relacionada_id;
ALTER TABLE objetos_empresas ALTER COLUMN empresa_relacionada_id DROP NOT NULL;
ALTER TABLE objetos_empresas ADD COLUMN contratista_id integer;
ALTER TABLE objetos_empresas ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN objetos_empresas.contratista_id IS 'Clave foranea a la tabla contratista';

create type objeto_autorizacion as enum ('DISTRIBUIDOR AUTORIZADO','DISTRIBUIDOR IMPORTADOR AUTORIZADO', 'SERVICIOS COMERCIALES AUTORIZADO');


ALTER TABLE objetos_autorizaciones ADD COLUMN tipo_objeto objeto_autorizacion;
ALTER TABLE objetos_autorizaciones ALTER COLUMN tipo_objeto SET NOT NULL;
COMMENT ON COLUMN objetos_autorizaciones.tipo_objeto IS 'enum de los posibles tipos, puede ser DISTRIBUIDOR AUTORIZADO , DISTRIBUIDOR IMPORTADOR AUTORIZADO, SERVICIOS COMERCIAES AUTORIZADO';


ALTER TABLE objetos_empresas ADD COLUMN productor boolean;
ALTER TABLE objetos_empresas ALTER COLUMN productor SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN productor SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.productor IS 'true si es productor';



ALTER TABLE objetos_empresas ADD COLUMN fabricante boolean;
ALTER TABLE objetos_empresas ALTER COLUMN fabricante SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN fabricante SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.fabricante IS 'true si es fabricante';


ALTER TABLE objetos_empresas ADD COLUMN fabricante_importado boolean;
ALTER TABLE objetos_empresas ALTER COLUMN fabricante_importado SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN fabricante_importado SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.fabricante_importado IS 'true si es fabricante importados';


ALTER TABLE objetos_empresas ADD COLUMN distribuidor boolean;
ALTER TABLE objetos_empresas ALTER COLUMN distribuidor SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN distribuidor SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.distribuidor IS 'true si es distribuidor';

ALTER TABLE objetos_empresas ADD COLUMN distribuidor_autorizado boolean;
ALTER TABLE objetos_empresas ALTER COLUMN distribuidor_autorizado SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN distribuidor_autorizado SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.distribuidor_autorizado IS 'true si es distribuidor autorizado';

ALTER TABLE objetos_empresas ADD COLUMN distribuidor_importador boolean;
ALTER TABLE objetos_empresas ALTER COLUMN distribuidor_importador SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN distribuidor_importador SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.distribuidor_importador IS 'true si es distribuidor importador';

ALTER TABLE objetos_empresas ADD COLUMN dist_importador_aut boolean;
ALTER TABLE objetos_empresas ALTER COLUMN dist_importador_aut SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN dist_importador_aut SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.dist_importador_aut IS 'true si es distribuidor importador autorizado';


ALTER TABLE objetos_empresas ADD COLUMN servicio_basico boolean;
ALTER TABLE objetos_empresas ALTER COLUMN servicio_basico SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN servicio_basico SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.servicio_basico IS 'true si es servicios basicos';


ALTER TABLE objetos_empresas ADD COLUMN servicio_profesional boolean;
ALTER TABLE objetos_empresas ALTER COLUMN servicio_profesional SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN servicio_profesional SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.servicio_profesional IS 'true si es servicios profesionales';


ALTER TABLE objetos_empresas ADD COLUMN servicio_comercial boolean;
ALTER TABLE objetos_empresas ALTER COLUMN servicio_comercial SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN servicio_comercial SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.servicio_comercial IS 'true si es servicios comerciales';

ALTER TABLE objetos_empresas ADD COLUMN ser_comercial_aut boolean;
ALTER TABLE objetos_empresas ALTER COLUMN ser_comercial_aut SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN ser_comercial_aut SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.ser_comercial_aut IS 'true si es servicios comerciales autorizado';


ALTER TABLE objetos_empresas ADD COLUMN obra boolean;
ALTER TABLE objetos_empresas ALTER COLUMN obra SET NOT NULL;
ALTER TABLE objetos_empresas ALTER COLUMN obra SET DEFAULT false;
COMMENT ON COLUMN objetos_empresas.obra IS 'true si es obras';


ALTER TABLE objetos_empresas
  ADD CONSTRAINT objetos_empresas_contratistda_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE objetos_empresas
  ADD CONSTRAINT objetos_empresas_empresa_relacionada_id_fkey FOREIGN KEY (empresa_relacionada_id)
      REFERENCES empresas_relacionadas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


-- 7 mayo 2015

alter table personas_juridicas rename column numero_identitifacion to numero_identificacion;

create type tipo_estado_civil as enum ('SOLTERO (A)', 'CASADO (A)','CONCUBINO (A)', 'DIVORCIADO (A)', 'VIUDO (A)');

ALTER TABLE personas_naturales ADD COLUMN estado_civil tipo_estado_civil;
COMMENT ON COLUMN personas_naturales.estado_civil IS 'Enum de los posibles estados civiles';

create type tipo_obligacion as enum ('FIRMA CONJUNTA', 'FIRMA SEPARADA');

 ALTER TABLE accionistas_otros DROP COLUMN obligacion;


ALTER TABLE accionistas_otros ADD COLUMN tipo_obligacion tipo_obligacion;
ALTER TABLE accionistas_otros ALTER COLUMN tipo_obligacion SET NOT NULL;
COMMENT ON COLUMN accionistas_otros.tipo_obligacion IS 'Enum puede ser FIRMA CONJUNTA FIRMA SEPARADA';


ALTER TABLE accionistas_otros ALTER COLUMN valor_compra DROP NOT NULL;

ALTER TABLE accionistas_otros ALTER COLUMN fecha DROP NOT NULL;

ALTER TABLE accionistas_otros ALTER COLUMN porcentaje_accionario DROP NOT NULL;

ALTER TABLE accionistas_otros ALTER COLUMN documento_registrado_id DROP NOT NULL;

-- MARCOS