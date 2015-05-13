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



-- 11 mayo de 2015

Alter type tipo_profesion ADD VALUE 'ECONOMISTA' BEFORE 'ABOGADO';
alter table comisarios_auditores alter column documento_registrado_id drop not null;



-- Mayo 12 2015
ALTER TABLE relaciones_contratos DROP COLUMN evaluacion_ente;

-- no pude pasar el tipo de dato a string por eso tuve que eliinarlo y crear uno nuevo

ALTER TABLE relaciones_contratos ADD COLUMN evaluacion_ente boolean;
ALTER TABLE relaciones_contratos ALTER COLUMN evaluacion_ente SET NOT NULL;
COMMENT ON COLUMN relaciones_contratos.evaluacion_ente IS 'Evaluacion del ente';

alter table comisarios_auditores alter column tipo_profesion drop not null;
alter table comisarios_auditores alter column fecha_carta drop not null;
alter table comisarios_auditores alter column fecha_vencimiento drop not null;


ALTER TABLE comisarios_auditores ADD COLUMN fecha_informe date;
COMMENT ON COLUMN comisarios_auditores.fecha_informe IS 'Fecha informe';




--13 mayo 2015

ALTER TABLE activos.documentos_registrados DROP COLUMN valor_adquisicion;

-- Table: sys_circunscripciones

-- DROP TABLE sys_circunscripciones;

CREATE TABLE sys_circunscripciones
(
  id serial NOT NULL, -- Clave primaria
  nombre character varying(255) NOT NULL, -- Nombre de la circunscripcion
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone DEFAULT now(), -- Fecha de "eliminado" el registro.
  CONSTRAINT sys_circunscripciones_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sys_circunscripciones
  OWNER TO eureka;
COMMENT ON TABLE sys_circunscripciones
  IS 'Tabla donde se almacenan las circunscripciones asociadas a documentos registrados';
COMMENT ON COLUMN sys_circunscripciones.id IS 'Clave primaria';
COMMENT ON COLUMN sys_circunscripciones.nombre IS 'Nombre de la circunscripcion';
COMMENT ON COLUMN sys_circunscripciones.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN sys_circunscripciones.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN sys_circunscripciones.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN sys_circunscripciones.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

ALTER TABLE activos.documentos_registrados DROP COLUMN circunscripcion;



ALTER TABLE activos.documentos_registrados ADD COLUMN sys_circunscripcion_id integer;
ALTER TABLE activos.documentos_registrados ALTER COLUMN sys_circunscripcion_id SET NOT NULL;
COMMENT ON COLUMN activos.documentos_registrados.sys_circunscripcion_id IS 'Clave foranea a la tabla sys_circunscripciones';



ALTER TABLE activos.documentos_registrados
  ADD CONSTRAINT documentos_registrados_sys_circunscripcion_id_fkey FOREIGN KEY (sys_circunscripcion_id)
      REFERENCES sys_circunscripciones (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;



ALTER TABLE duraciones_empresas ADD COLUMN duracion_anos integer;
ALTER TABLE duraciones_empresas ALTER COLUMN duracion_anos SET NOT NULL;
COMMENT ON COLUMN duraciones_empresas.duracion_anos IS 'Años de duracion';



ALTER TABLE actividades_economicas ADD COLUMN documento_registrado_id integer;
ALTER TABLE actividades_economicas ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN actividades_economicas.documento_registrado_id IS 'Clave foranea a la tabla documentos registrados';


ALTER TABLE actividades_economicas
  ADD CONSTRAINT actividades_economicas_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE actividades_economicas ALTER COLUMN comp2_experiencia SET NOT NULL;