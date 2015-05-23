
----- 22 mayo 11 pm -----


ALTER TABLE acciones ADD COLUMN capital numeric(38,6);
COMMENT ON COLUMN acciones.capital IS 'Capital total en bs, solo para ser cargado en el acta constitutiva';


ALTER TABLE certificados ADD COLUMN capital numeric(38,6);
COMMENT ON COLUMN certificados.capital IS 'Capital total en bs, solo para ser cargado en el acta constitutiva';


ALTER TABLE suplementarios ADD COLUMN capital numeric(38,6);
COMMENT ON COLUMN suplementarios.capital IS 'Capital total en bs, solo para ser cargado en el acta constitutiva';