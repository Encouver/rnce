ALTER TABLE contratistas ADD COLUMN acta_constitutiva boolean;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET NOT NULL;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET DEFAULT false;
COMMENT ON COLUMN contratistas.acta_constitutiva IS 'Indica si el acta constitutiva ya fue cargada';

ALTER TABLE contratistas DROP COLUMN acta_constitutiva;

ALTER TABLE denominaciones_comerciales ADD COLUMN documento_registrado_id integer;
ALTER TABLE denominaciones_comerciales ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN denominaciones_comerciales.documento_registrado_id IS 'Clave foranea a la tabla documentos_registrados';

ALTER TABLE activos.documentos_registrados ADD COLUMN proceso_finalizado boolean;
ALTER TABLE activos.documentos_registrados ALTER COLUMN proceso_finalizado SET NOT NULL;
ALTER TABLE activos.documentos_registrados ALTER COLUMN proceso_finalizado SET DEFAULT true;
COMMENT ON COLUMN activos.documentos_registrados.proceso_finalizado IS 'Junto a tipo_documento_id me indica si es un acta o una modificacion';



----27 mayo 10:30 pm--

ALTER TABLE principios_contables DROP COLUMN principio_contable;

ALTER TABLE principios_contables ADD COLUMN principio_contable character varying(100);
ALTER TABLE principios_contables ALTER COLUMN principio_contable SET NOT NULL;
COMMENT ON COLUMN principios_contables.principio_contable IS 'Nombre del principio contable aplicable';


-----28 mayo 12:51 am----
ALTER TABLE denominaciones_comerciales
  ADD CONSTRAINT denominaciones_comerciales_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;



ALTER TABLE razones_sociales ADD COLUMN documento_registrado_id integer;
ALTER TABLE razones_sociales ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN razones_sociales.documento_registrado_id IS 'Clave foranea a la tabla documentos registrados del esquema activos';


ALTER TABLE razones_sociales
  ADD CONSTRAINT razones_sociales_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE duraciones_empresas DROP COLUMN fecha_vencimiento;


------28 mayo 2015 4:00 pm---

ALTER TABLE sys_naturales_juridicas ADD COLUMN nacional boolean;
ALTER TABLE sys_naturales_juridicas ALTER COLUMN nacional SET NOT NULL;
ALTER TABLE sys_naturales_juridicas ALTER COLUMN nacional SET DEFAULT true;
COMMENT ON COLUMN sys_naturales_juridicas.nacional IS 'true nacionalidad es venezolano, false extranjero';

ALTER TABLE personas_juridicas ALTER COLUMN rif SET NOT NULL;
ALTER TABLE personas_naturales ALTER COLUMN rif SET NOT NULL;

ALTER TABLE personas_juridicas ALTER COLUMN tipo_nacionalidad SET NOT NULL;
ALTER TABLE personas_juridicas ALTER COLUMN tipo_nacionalidad SET DEFAULT 'NACIONAL'::tipo_nacionalidad;
ALTER TABLE personas_juridicas ALTER COLUMN tipo_nacionalidad DROP DEFAULT;

ALTER TABLE personas_juridicas ALTER COLUMN sys_pais_id SET NOT NULL;


---29 mayo 2015 09:00 am---

ALTER TABLE sucursales ADD COLUMN documento_registrado_id integer;
ALTER TABLE sucursales ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN sucursales.documento_registrado_id IS 'Clave a la tabla documentos_registrados';

ALTER TABLE sucursales
  ADD CONSTRAINT sucursales_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;



--29 mayo 2:00 pm--

ALTER TABLE contratos_facturas
  ADD CONSTRAINT factura_contrato_orden UNIQUE(relacion_contrato_id, orden_factura);

ALTER TABLE contratos_valuaciones
  ADD CONSTRAINT valuacion_contrato_orden UNIQUE(relacion_contrato_id, orden_valuacion);

--30 mayo 11:00am---
ALTER TABLE domicilios ALTER COLUMN documento_registrado_id SET NOT NULL;


-- 01 junio 2015--

ALTER TABLE actas_constitutivas DROP COLUMN domicilio_id;

ALTER TABLE actas_constitutivas ADD COLUMN domicilio_fiscal_id integer;
ALTER TABLE actas_constitutivas ALTER COLUMN domicilio_fiscal_id SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.domicilio_fiscal_id IS 'Clave foranea a la tabla domicilios';

ALTER TABLE actas_constitutivas ADD COLUMN domicilio_principal_id integer;
ALTER TABLE actas_constitutivas ALTER COLUMN domicilio_principal_id SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.domicilio_principal_id IS 'Clave foranea a la tabla domicilios';

ALTER TABLE actas_constitutivas DROP COLUMN accionista_otro;

ALTER TABLE actas_constitutivas
  ADD CONSTRAINT actas_constitutivas_domicilio_fiscal_id_fkey FOREIGN KEY (domicilio_fiscal_id)
      REFERENCES domicilios (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE actas_constitutivas
  ADD CONSTRAINT actas_constitutivas_domicilio_principal_id_fkey FOREIGN KEY (domicilio_principal_id)
      REFERENCES domicilios (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE actas_constitutivas DROP COLUMN pago_capital;
ALTER TABLE actas_constitutivas DROP COLUMN aporte_capitalizar;
ALTER TABLE actas_constitutivas DROP COLUMN aumento_capital;
ALTER TABLE actas_constitutivas DROP COLUMN coreccion_monetaria;
ALTER TABLE actas_constitutivas DROP COLUMN disminucion_capital;
ALTER TABLE actas_constitutivas DROP COLUMN limitacion_capital;
ALTER TABLE actas_constitutivas DROP COLUMN limitacion_capital_afectado;
ALTER TABLE actas_constitutivas DROP COLUMN fondo_emergencia;
ALTER TABLE actas_constitutivas DROP COLUMN reintegro_perdida;
ALTER TABLE actas_constitutivas DROP COLUMN venta_accion;
ALTER TABLE actas_constitutivas DROP COLUMN fusion_empresarial;
ALTER TABLE actas_constitutivas DROP COLUMN decreto_div_excedente;
ALTER TABLE actas_constitutivas DROP COLUMN modificacion_balance;
ALTER TABLE actas_constitutivas DROP COLUMN fecha_modificacion;
ALTER TABLE actas_constitutivas DROP COLUMN capital_principal;

ALTER TABLE actas_constitutivas ADD COLUMN acciones boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN acciones SET NOT NULL;
ALTER TABLE actas_constitutivas ALTER COLUMN acciones SET DEFAULT false;
COMMENT ON COLUMN actas_constitutivas.acciones IS 'Si posee datos en la tabla acciones';

ALTER TABLE actas_constitutivas ADD COLUMN certificados boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN certificados SET NOT NULL;
ALTER TABLE actas_constitutivas ALTER COLUMN certificados SET DEFAULT false;
COMMENT ON COLUMN actas_constitutivas.certificados IS 'Si posee o no datos en la tabla certificados';



ALTER TABLE actas_constitutivas ADD COLUMN suplementarios boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN suplementarios SET NOT NULL;
ALTER TABLE actas_constitutivas ALTER COLUMN suplementarios SET DEFAULT false;
COMMENT ON COLUMN actas_constitutivas.suplementarios IS 'Si posee o no datos enla tabla suplementarios';

ALTER TABLE actas_constitutivas ADD COLUMN capital_suscrito numeric(38,6);
ALTER TABLE actas_constitutivas ALTER COLUMN capital_suscrito SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.capital_suscrito IS 'Monto del capital suscrito actual';

ALTER TABLE actas_constitutivas ADD COLUMN capital_pagado numeric(38,6);
ALTER TABLE actas_constitutivas ALTER COLUMN capital_pagado SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.capital_pagado IS 'Monto del capital pagado';

ALTER TABLE actas_constitutivas ADD COLUMN actual boolean;
ALTER TABLE actas_constitutivas ALTER COLUMN actual SET NOT NULL;
ALTER TABLE actas_constitutivas ALTER COLUMN actual SET DEFAULT true;
COMMENT ON COLUMN actas_constitutivas.actual IS 'Si es o no el acta constitutiva actual';

ALTER TABLE actas_constitutivas ADD COLUMN modificacion_acta_id integer;
ALTER TABLE actas_constitutivas ALTER COLUMN modificacion_acta_id SET NOT NULL;
COMMENT ON COLUMN actas_constitutivas.modificacion_acta_id IS 'Clave foranea a la tabla modificaciones_actas';





-- Table: modificaciones_actas

-- DROP TABLE modificaciones_actas;

CREATE TABLE modificaciones_actas
(
  id serial NOT NULL, -- Clave primaria
  contratista_id integer NOT NULL, -- Clave foranea tabla contratistas
  documento_registrado_id integer NOT NULL, -- Clave foranea a ala tabla documento registrado en el esquema activo
  pago_capital boolean NOT NULL DEFAULT false, -- Si es true se busca informacion en acciones, certificados o suplmentarios
  aporte_capitalizar boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla aportes_capitalizar
  aumento_capital boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla aumento_capital
  coreccion_monetaria boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla correciones_monetarias
  disminucion_capital boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla acciones_disminuidas_ certificados_disminuidos o suplemenatrios_disminuidos
  limitacion_capital boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla limitaciones_capitales
  limitacion_capital_afectado boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla limitaciones_capitales_afectados
  fondo_emergencia boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla fondos_emergencias
  reintegro_perdida boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla limitaciones_capitales
  venta_accion boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla acciones, certificados, suplementarios
  fusion_empresarial boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla fusiones_empresariales
  decreto_div_excedente boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla decreto_div_excedentes
  modificacion_balance boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla modificaciones_balances
  razon_social boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla razones_sociales
  denominacion_comercial boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla denominaciones_comerciales
  domicilio_fiscal boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla domicilios
  domicilio_principal boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla domicilios
  objeto_social boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla objetos_sociales
  representante_legal boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla accionistas_otros
  junta_directiva boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla accionistas-otros
  duracion_empresa boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla duraciones_empresas
  cierre_ejercicio boolean NOT NULL DEFAULT false, -- True se busca informacion en la tabla cierre_ejercicios
  creado_por integer, -- Clave foranea al usuario
  actualizado_por integer, -- Clave foranea al usuario
  sys_status boolean NOT NULL DEFAULT true, -- Estatus interno del sistema
  sys_creado_el timestamp with time zone DEFAULT now(), -- Fecha de creación del registro.
  sys_actualizado_el timestamp with time zone DEFAULT now(), -- Fecha de última actualización del registro.
  sys_finalizado_el timestamp with time zone, -- Fecha de "eliminado" el registro.
  CONSTRAINT modificaciones_pkey PRIMARY KEY (id),
  CONSTRAINT modificaciones_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT modificaciones_documento_registrado_id FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE modificaciones_actas
  OWNER TO eureka;
COMMENT ON TABLE modificaciones_actas
  IS 'Tabla donde se almacenan el acta constitutiva de la contratista.';
COMMENT ON COLUMN modificaciones_actas.id IS 'Clave primaria';
COMMENT ON COLUMN modificaciones_actas.contratista_id IS 'Clave foranea tabla contratistas';
COMMENT ON COLUMN modificaciones_actas.documento_registrado_id IS 'Clave foranea a ala tabla documento registrado en el esquema activo';
COMMENT ON COLUMN modificaciones_actas.pago_capital IS 'Si es true se busca informacion en acciones, certificados o suplmentarios';
COMMENT ON COLUMN modificaciones_actas.aporte_capitalizar IS 'True se busca informacion en la tabla aportes_capitalizar';
COMMENT ON COLUMN modificaciones_actas.aumento_capital IS 'True se busca informacion en la tabla aumento_capital';
COMMENT ON COLUMN modificaciones_actas.coreccion_monetaria IS 'True se busca informacion en la tabla correciones_monetarias';
COMMENT ON COLUMN modificaciones_actas.disminucion_capital IS 'True se busca informacion en la tabla acciones_disminuidas_ certificados_disminuidos o suplemenatrios_disminuidos';
COMMENT ON COLUMN modificaciones_actas.limitacion_capital IS 'True se busca informacion en la tabla limitaciones_capitales';
COMMENT ON COLUMN modificaciones_actas.limitacion_capital_afectado IS 'True se busca informacion en la tabla limitaciones_capitales_afectados';
COMMENT ON COLUMN modificaciones_actas.fondo_emergencia IS 'True se busca informacion en la tabla fondos_emergencias';
COMMENT ON COLUMN modificaciones_actas.reintegro_perdida IS 'True se busca informacion en la tabla limitaciones_capitales';
COMMENT ON COLUMN modificaciones_actas.venta_accion IS 'True se busca informacion en la tabla acciones, certificados, suplementarios';
COMMENT ON COLUMN modificaciones_actas.fusion_empresarial IS 'True se busca informacion en la tabla fusiones_empresariales';
COMMENT ON COLUMN modificaciones_actas.decreto_div_excedente IS 'True se busca informacion en la tabla decreto_div_excedentes';
COMMENT ON COLUMN modificaciones_actas.modificacion_balance IS 'True se busca informacion en la tabla modificaciones_balances';
COMMENT ON COLUMN modificaciones_actas.razon_social IS 'True se busca informacion en la tabla razones_sociales';
COMMENT ON COLUMN modificaciones_actas.denominacion_comercial IS 'True se busca informacion en la tabla denominaciones_comerciales';
COMMENT ON COLUMN modificaciones_actas.domicilio_fiscal IS 'True se busca informacion en la tabla domicilios';
COMMENT ON COLUMN modificaciones_actas.domicilio_principal IS 'True se busca informacion en la tabla domicilios';
COMMENT ON COLUMN modificaciones_actas.objeto_social IS 'True se busca informacion en la tabla objetos_sociales';
COMMENT ON COLUMN modificaciones_actas.representante_legal IS 'True se busca informacion en la tabla accionistas_otros';
COMMENT ON COLUMN modificaciones_actas.junta_directiva IS 'True se busca informacion en la tabla accionistas-otros';
COMMENT ON COLUMN modificaciones_actas.duracion_empresa IS 'True se busca informacion en la tabla duraciones_empresas';
COMMENT ON COLUMN modificaciones_actas.cierre_ejercicio IS 'True se busca informacion en la tabla cierre_ejercicios';
COMMENT ON COLUMN modificaciones_actas.creado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN modificaciones_actas.actualizado_por IS 'Clave foranea al usuario';
COMMENT ON COLUMN modificaciones_actas.sys_status IS 'Estatus interno del sistema';
COMMENT ON COLUMN modificaciones_actas.sys_creado_el IS 'Fecha de creación del registro.';
COMMENT ON COLUMN modificaciones_actas.sys_actualizado_el IS 'Fecha de última actualización del registro.';
COMMENT ON COLUMN modificaciones_actas.sys_finalizado_el IS 'Fecha de "eliminado" el registro.';

ALTER TABLE actas_constitutivas
  ADD CONSTRAINT actas_constitutivas_modificacion_acta_id_fkey FOREIGN KEY (modificacion_acta_id)
      REFERENCES modificaciones_actas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

---02 junio 2015 5:00 pm--
ALTER TABLE duraciones_empresas DROP COLUMN tiempo_prorroga;

---03 junio 2015 08:30---
ALTER TABLE actas_constitutivas DROP COLUMN comisario_auditor_id;


--04 JUNIO 2015 12:00M--

ALTER TABLE empresas_relacionadas ADD COLUMN documento_registrado_id integer;
COMMENT ON COLUMN empresas_relacionadas.documento_registrado_id IS 'Clave foranea a la tabla documentos registrados';


ALTER TABLE empresas_relacionadas
  ADD CONSTRAINT empresas_relacionadas_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE empresas_relacionadas DROP COLUMN tipo_sector;
ALTER TABLE empresas_relacionadas DROP COLUMN persona_juridica_id;
ALTER TABLE empresas_relacionadas DROP COLUMN persona_contacto_id;

ALTER TABLE empresas_relacionadas ADD COLUMN persona_juridica_id integer;
ALTER TABLE empresas_relacionadas ALTER COLUMN persona_juridica_id SET NOT NULL;
COMMENT ON COLUMN empresas_relacionadas.persona_juridica_id IS 'Clave foranea a la tabla sys_naturales_juridicas';

ALTER TABLE empresas_relacionadas ADD COLUMN persona_contacto_id integer;
ALTER TABLE empresas_relacionadas ALTER COLUMN persona_contacto_id SET NOT NULL;
COMMENT ON COLUMN empresas_relacionadas.persona_contacto_id IS 'Clave foranea a la tabla sys_naturales_juridicas';

ALTER TABLE empresas_relacionadas
  ADD CONSTRAINT empresas_relacionada_spersona_juridica_id_fkey FOREIGN KEY (persona_juridica_id)
      REFERENCES sys_naturales_juridicas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE empresas_relacionadas
  ADD CONSTRAINT empresas_relacionadas_persona_contacto_id_fkey FOREIGN KEY (persona_contacto_id)
      REFERENCES sys_naturales_juridicas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;



ALTER TABLE objetos_empresas DROP COLUMN empresa_relacionada_id;
LTER TABLE empresas_relacionadas DROP COLUMN sys_pais_id;


---04 junio 7:35 pm---


ALTER TABLE empresas_relacionadas ADD COLUMN objeto_empresa text;
ALTER TABLE empresas_relacionadas ALTER COLUMN objeto_empresa SET NOT NULL;
COMMENT ON COLUMN empresas_relacionadas.objeto_empresa IS 'Objeto de la empresa';


---05 junio 8:30 pm--


ALTER TABLE certificaciones_aportes DROP COLUMN documento_registrado_id;

ALTER TABLE acciones ADD COLUMN certificacion_aporte_id integer;
COMMENT ON COLUMN acciones.certificacion_aporte_id IS 'Clave foranea a la tabla certificaciones_aportes';


ALTER TABLE acciones
  ADD CONSTRAINT acciones_certificacion_aporte_id_fkey FOREIGN KEY (certificacion_aporte_id)
      REFERENCES certificaciones_aportes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE certificados ADD COLUMN certificacion_aporte_id integer;
COMMENT ON COLUMN certificados.certificacion_aporte_id IS 'Clave foranea a la tabla certificaciones_aportes';


ALTER TABLE certificados
  ADD CONSTRAINT certificados_certificacion_aporte_id_fkey FOREIGN KEY (certificacion_aporte_id)
      REFERENCES certificaciones_aportes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE suplementarios ADD COLUMN certificacion_aporte_id integer;
COMMENT ON COLUMN suplementarios.certificacion_aporte_id IS 'Clave foranea a la tabla certificaciones_aportes';


ALTER TABLE suplementarios
  ADD CONSTRAINT suplementarios_certificacion_aporte_id_fkey FOREIGN KEY (certificacion_aporte_id)
      REFERENCES certificaciones_aportes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;


CREATE TYPE tipo_origen_capital as enum ('PRINCIPAL','PAGO_CAPITAL','APORTE_CAPITALIZAR','AUMENTO_CAPITAL','DISMINUCION_CAPITAL','FONDO_EMERGENCIA','REINTEGRO_PERDIDA','FUSION_EMPRESARIAL');

ALTER TABLE origenes_capitales ADD COLUMN tipo_origen tipo_origen_capital;
ALTER TABLE origenes_capitales ALTER COLUMN tipo_origen SET NOT NULL;
COMMENT ON COLUMN origenes_capitales.tipo_origen IS 'Tipo origen puede ser PRINCIPAL,PAGO_CAPITAL, APORTE_CAPITALIZAR, AUMENTO_CAPITAL, DISMINUCION_CAPITAL, FONDO_EMERGENCIA, REINTEGRO_PERDIDA, FUSION_EMPRESARIAL';

ALTER TABLE origenes_capitales ADD COLUMN principal boolean;
ALTER TABLE origenes_capitales ALTER COLUMN principal SET NOT NULL;
COMMENT ON COLUMN origenes_capitales.principal IS 'true si es parte del acta, false si es parte de una modificacion';


---08 junio 10:05 am--
ALTER TABLE acciones ADD COLUMN actual boolean;
ALTER TABLE acciones ALTER COLUMN actual SET NOT NULL;
ALTER TABLE acciones ALTER COLUMN actual SET DEFAULT false;
COMMENT ON COLUMN acciones.actual IS 'true significa que el valor de las acciones es el actual';

--08 j-unio 2:00 pm-
ALTER TABLE origenes_capitales ALTER COLUMN monto DROP NOT NULL;

ALTER TABLE certificados ADD COLUMN actual boolean;
ALTER TABLE certificados ALTER COLUMN actual SET NOT NULL;
ALTER TABLE certificados ALTER COLUMN actual SET DEFAULT false;
COMMENT ON COLUMN certificados.actual IS 'true significa que el valor de los certificados es el actual';


ALTER TABLE suplementarios ADD COLUMN actual boolean;
ALTER TABLE suplementarios ALTER COLUMN actual SET NOT NULL;
ALTER TABLE suplementarios ALTER COLUMN actual SET DEFAULT false;
COMMENT ON COLUMN suplementarios.actual IS 'true significa que el valor de los suplementarios es el actual';


--10 junio 12:45--
ALTER TABLE aportes_capitalizar DROP COLUMN acta_constitutiva_id;
ALTER TABLE certificaciones_aportes DROP COLUMN fecha_informe;

ALTER TABLE acciones ADD COLUMN fecha_informe date;
ALTER TABLE acciones ALTER COLUMN fecha_informe SET NOT NULL;
COMMENT ON COLUMN acciones.fecha_informe IS 'Fecha informe de la certificacion_aporte';

ALTER TABLE certificados ADD COLUMN fecha_informe date;
ALTER TABLE certificados ALTER COLUMN fecha_informe SET NOT NULL;
COMMENT ON COLUMN certificados.fecha_informe IS 'Fecha informe de la certificacion_aporte';

ALTER TABLE suplementarios ADD COLUMN fecha_informe date;
ALTER TABLE suplementarios ALTER COLUMN fecha_informe SET NOT NULL;
COMMENT ON COLUMN suplementarios.fecha_informe IS 'Fecha informe de la certificacion_aporte';

ALTER TABLE aportes_capitalizar ADD COLUMN contratista_id integer;
ALTER TABLE aportes_capitalizar ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN aportes_capitalizar.contratista_id IS 'Clave foranea a la tabla contratistas';

ALTER TABLE aportes_capitalizar ADD COLUMN documento_registrado_id integer;
ALTER TABLE aportes_capitalizar ALTER COLUMN documento_registrado_id SET NOT NULL;
COMMENT ON COLUMN aportes_capitalizar.documento_registrado_id IS 'Clave foranea a la tabal documentos registrados';

ALTER TABLE aportes_capitalizar ADD COLUMN certificacion_aporte_id integer;
ALTER TABLE aportes_capitalizar ALTER COLUMN certificacion_aporte_id SET NOT NULL;
COMMENT ON COLUMN aportes_capitalizar.certificacion_aporte_id IS 'Clave foranea a la tabla certificaciones_aportes';

ALTER TABLE aportes_capitalizar ADD COLUMN fecha_informe date;
ALTER TABLE aportes_capitalizar ALTER COLUMN fecha_informe SET NOT NULL;
COMMENT ON COLUMN aportes_capitalizar.fecha_informe IS 'Fehca informe de la certificacion del aporte';

ALTER TABLE aportes_capitalizar
  ADD CONSTRAINT aportes_capitalizar_certificacion_aporte_id_fkey FOREIGN KEY (certificacion_aporte_id)
      REFERENCES certificaciones_aportes (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE aportes_capitalizar
  ADD CONSTRAINT aportes_capitalizar_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE aportes_capitalizar
  ADD CONSTRAINT aportes_capitalizar_documento_registrado_id_fkey FOREIGN KEY (documento_registrado_id)
      REFERENCES activos.documentos_registrados (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;


