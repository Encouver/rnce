-- Column: contratista_id

-- ALTER TABLE "user" DROP COLUMN contratista_id;

ALTER TABLE "user" ADD COLUMN contratista_id integer;
COMMENT ON COLUMN "user".contratista_id IS 'Clave foránea a la tabla contratista. Indica el vinculo del usuario con la contratista.';
