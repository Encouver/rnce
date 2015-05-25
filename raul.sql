
----- 22 mayo 11 pm -----


ALTER TABLE acciones ADD COLUMN capital numeric(38,6);
COMMENT ON COLUMN acciones.capital IS 'Capital total en bs, solo para ser cargado en el acta constitutiva';


ALTER TABLE certificados ADD COLUMN capital numeric(38,6);
COMMENT ON COLUMN certificados.capital IS 'Capital total en bs, solo para ser cargado en el acta constitutiva';


ALTER TABLE suplementarios ADD COLUMN capital numeric(38,6);
COMMENT ON COLUMN suplementarios.capital IS 'Capital total en bs, solo para ser cargado en el acta constitutiva';



-----23 mayo 2015 2:30 pm----

ALTER TABLE personas_naturales ALTER COLUMN segundo_nombre DROP NOT NULL;
ALTER TABLE personas_naturales ALTER COLUMN segundo_apellido DROP NOT NULL;


ALTER TABLE "user"
  ADD CONSTRAINT user_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;


-- 24 mayo 00:07 am ---

ALTER TABLE bancos_contratistas ALTER COLUMN tipo_moneda Drop NOT NULL;
ALTER TABLE bancos_contratistas ALTER COLUMN tipo_cuenta Drop NOT NULL;



--24 mayo 12:30 m ----

ALTER TABLE objetos_autorizaciones DROP COLUMN objeto_empresa_id;
create type tipo_objeto_empresa as enum ('PRODUCTOR','FABRICANTE','FABRICANTE IMPORTADOR','DISTRIBUIDOR','DISTRIBUIDOR IMPORTADOR','SERVICIOS BASICOS','SERVICIOS PROFESIONALES','SERVICIOS COMERCIALES','OBRAS');
ALTER TABLE objetos_empresas DROP COLUMN distribuidor_importador;
ALTER TABLE objetos_empresas DROP COLUMN servicio_basico;
ALTER TABLE objetos_empresas DROP COLUMN dist_importador_aut;
ALTER TABLE objetos_empresas DROP COLUMN servicio_comercial;
ALTER TABLE objetos_empresas DROP COLUMN servicio_profesional;
ALTER TABLE objetos_empresas DROP COLUMN obra;
ALTER TABLE objetos_empresas DROP COLUMN productor;
ALTER TABLE objetos_empresas DROP COLUMN fabricante;
ALTER TABLE objetos_empresas DROP COLUMN fabricante_importado;
ALTER TABLE objetos_empresas DROP COLUMN distribuidor;
ALTER TABLE objetos_empresas DROP COLUMN ser_comercial_aut;
ALTER TABLE objetos_empresas DROP COLUMN distribuidor_autorizado;
ALTER TABLE objetos_empresas ADD COLUMN objeto_empresa tipo_objeto_empresa;
ALTER TABLE objetos_empresas ALTER COLUMN objeto_empresa SET NOT NULL;
COMMENT ON COLUMN objetos_empresas.objeto_empresa IS 'Tipo objeto empresa puede ser PRODUCTOR, FABRICANTE, FABRICANTE IMPORTADOR, DISTRIBUIDOR, DISTRIBUIDOR IMPORTADOR, SERVICIOS BASICOS, SERVICIOS PROFESIONALES, SERVICIOS COMERCIALES , OBRAS';



ALTER TABLE personas_juridicas ADD COLUMN sys_pais_id integer;
COMMENT ON COLUMN personas_juridicas.sys_pais_id IS 'Clave foranea a la tabla paises en caso de ser de nacionalidad extranjera';



ALTER TABLE objetos_autorizaciones DROP COLUMN persona_juridica_id;

ALTER TABLE objetos_autorizaciones ADD COLUMN natural_juridica_id integer;
ALTER TABLE objetos_autorizaciones ALTER COLUMN natural_juridica_id SET NOT NULL;
COMMENT ON COLUMN objetos_autorizaciones.natural_juridica_id IS 'Clave foranea ala tabla sys_naturales_juridicas';

ALTER TABLE objetos_autorizaciones
  ADD CONSTRAINT objetos_autorizaciones_natural_juridica_id_fkey FOREIGN KEY (natural_juridica_id)
      REFERENCES sys_naturales_juridicas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE objetos_autorizaciones ADD COLUMN contratista_id integer;
ALTER TABLE objetos_autorizaciones ALTER COLUMN contratista_id SET NOT NULL;
COMMENT ON COLUMN objetos_autorizaciones.contratista_id IS 'clave foranea a la tabla contratistas';


ALTER TABLE objetos_autorizaciones
  ADD CONSTRAINT objetos_autorizaciones_contratista_id_fkey FOREIGN KEY (contratista_id)
      REFERENCES contratistas (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;




-----24 mayo 05:21---

ALTER TABLE accionistas_otros ALTER COLUMN documento_registrado_id SET NOT NULL;

ALTER TABLE personas_juridicas
  ADD CONSTRAINT personas_juridicas_sys_pais_id_fkey FOREIGN KEY (sys_pais_id)
      REFERENCES sys_paises (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;



---24 mayo 06-00 pm---


ALTER TABLE accionistas_otros ADD COLUMN empresa_relacionada boolean;
ALTER TABLE accionistas_otros ALTER COLUMN empresa_relacionada SET NOT NULL;
ALTER TABLE accionistas_otros ALTER COLUMN empresa_relacionada SET DEFAULT false;
COMMENT ON COLUMN accionistas_otros.empresa_relacionada IS 'Si el accionista proviene de una fusion empresarial';


ALTER TABLE accionistas_otros DROP COLUMN cargo;

create type tipo_accionista_carga as enum ('PRESIDENTE','DIRECTOR','VOCERO DE LA UNIDAD DE ADMINISTRACION','VOCERO DE LA UNIDAD DE GESTION PRODUCTIVA','VOCERO DE LA UNIDAD DE FORMACION','VOCERO DE LA UNIDAD DE CONTRALORIA SOCIAL','INSTANCIA DE ADMINISTRACION','INSTANCIA DE CONTROL Y EVALUACION','INSTANCIA DE EDUCACION');
ALTER TABLE accionistas_otros ADD COLUMN tipo_cargo tipo_accionista_carga;
COMMENT ON COLUMN accionistas_otros.tipo_cargo IS 'Tipo de cargo en caso de ser partede la junta directiva puede ser PRESIDENTE, DIRECTOR, VOCERO DE LA UNIDAD DE ADMINISTRACION, VOCERO DE LA UNIDAD DE GESTION PRODUCTIVA, VOCERO DE LA UNIDAD DE FORMACION,VOCERO DE LA UNIDAD DE CONTRALORIA SOCIAL,INSTANCIA DE ADMINISTRACION, INSTANCIA DE CONTROL Y EVALUACION INSTANCIA DE EDUCACION';

ALTER TABLE accionistas_otros ALTER COLUMN accionista SET DEFAULT false;
ALTER TABLE accionistas_otros ALTER COLUMN junta_directiva SET DEFAULT false;
ALTER TABLE accionistas_otros ALTER COLUMN rep_legal SET DEFAULT false;

