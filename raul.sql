
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
      ON UPDATE CASCADE ON DELETE CASCADE;
