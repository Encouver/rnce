ALTER TABLE contratistas ADD COLUMN acta_constitutiva boolean;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET NOT NULL;
ALTER TABLE contratistas ALTER COLUMN acta_constitutiva SET DEFAULT false;
COMMENT ON COLUMN contratistas.acta_constitutiva IS 'Indica si el acta constitutiva ya fue cargada';
