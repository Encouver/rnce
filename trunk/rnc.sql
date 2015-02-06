PGDMP     (                    s            rnc    9.3.2    9.3.2 �   7	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            8	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            9	           1262    364118    rnc    DATABASE     �   CREATE DATABASE rnc WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Bolivarian Republic of Venezuela.1252' LC_CTYPE = 'Spanish_Bolivarian Republic of Venezuela.1252';
    DROP DATABASE rnc;
             eureka    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            :	           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    6            ;	           0    0    public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  postgres    false    6            �            3079    11750    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            <	           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    229            ?           1247    364120 	   enum_caja    TYPE     @   CREATE TYPE enum_caja AS ENUM (
    'caja',
    'caja chica'
);
    DROP TYPE public.enum_caja;
       public       eureka    false    6            �           1247    364900    enum_concepto    TYPE     O   CREATE TYPE enum_concepto AS ENUM (
    'venta',
    'servicio',
    'obra'
);
     DROP TYPE public.enum_concepto;
       public       postgres    false    6            B           1247    364126    enum_gastos    TYPE     �  CREATE TYPE enum_gastos AS ENUM (
    'Intereses',
    'Arrendamiento de bienes inmuebles',
    'Arrendamiento de bienes muebles',
    'Pólizas de seguro',
    'Fianza Fiel cumplimiento',
    'Fianza garantía laboral',
    'Otros pagos anticipado (Especificar)',
    'Existencia artículos de oficina',
    'Existencia artículos de limpieza',
    'Otras existencias (Especificar)'
);
    DROP TYPE public.enum_gastos;
       public       eureka    false    6            E           1247    364148    enum_inventario    TYPE     1  CREATE TYPE enum_inventario AS ENUM (
    'Materias primas',
    'Productos en proceso',
    'Productos terminados',
    'Materiales y suministros',
    'Repuestos, accesorios y herramientas',
    'Material de empaque y embalaje',
    'Mercancías',
    'Servicios en proceso',
    'Otros inventarios'
);
 "   DROP TYPE public.enum_inventario;
       public       eureka    false    6            H           1247    364168 	   enum_islr    TYPE     |   CREATE TYPE enum_islr AS ENUM (
    'Declaración estimada',
    'Retenido por clientes',
    'Otros créditos fiscales'
);
    DROP TYPE public.enum_islr;
       public       eureka    false    6            K           1247    364176    enum_iva_otros    TYPE     �   CREATE TYPE enum_iva_otros AS ENUM (
    'Excedente de crédito fiscal',
    'Retenido por clientes',
    'Otros créditos fiscales',
    'Otros tributos pagados por anticipado'
);
 !   DROP TYPE public.enum_iva_otros;
       public       eureka    false    6            N           1247    364186 
   enum_meses    TYPE     �   CREATE TYPE enum_meses AS ENUM (
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
);
    DROP TYPE public.enum_meses;
       public       eureka    false    6            Q           1247    364212    enum_otros_activos    TYPE     R   CREATE TYPE enum_otros_activos AS ENUM (
    'Corrientes',
    'No Corrientes'
);
 %   DROP TYPE public.enum_otros_activos;
       public       eureka    false    6            T           1247    364218    enum_sector    TYPE     B   CREATE TYPE enum_sector AS ENUM (
    'Privado',
    'Publico'
);
    DROP TYPE public.enum_sector;
       public       eureka    false    6            W           1247    364224    enum_tipo_propiedad    TYPE     K   CREATE TYPE enum_tipo_propiedad AS ENUM (
    'Terreno',
    'Edificio'
);
 &   DROP TYPE public.enum_tipo_propiedad;
       public       eureka    false    6            �           1247    365012    tipo_cuentas    TYPE     ;   CREATE TYPE tipo_cuentas AS ENUM (
    'pub',
    'pri'
);
    DROP TYPE public.tipo_cuentas;
       public       postgres    false    6            �            1259    364229    bancos    TABLE     �   CREATE TABLE bancos (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    rif character varying(100) NOT NULL,
    codigo_sudeban character varying(5) NOT NULL
);
    DROP TABLE public.bancos;
       public         eureka    false    6            =	           0    0    COLUMN bancos.id    COMMENT     1   COMMENT ON COLUMN bancos.id IS 'Clave primaria';
            public       eureka    false    170            >	           0    0    COLUMN bancos.nombre    COMMENT     7   COMMENT ON COLUMN bancos.nombre IS 'Nombre del banco';
            public       eureka    false    170            ?	           0    0    COLUMN bancos.rif    COMMENT     1   COMMENT ON COLUMN bancos.rif IS 'Rif del banco';
            public       eureka    false    170            @	           0    0    COLUMN bancos.codigo_sudeban    COMMENT     S   COMMENT ON COLUMN bancos.codigo_sudeban IS 'Codigo de sudeban asociado al banco.';
            public       eureka    false    170            �            1259    364232    Bancos_id_seq    SEQUENCE     q   CREATE SEQUENCE "Bancos_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public."Bancos_id_seq";
       public       eureka    false    6    170            A	           0    0    Bancos_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE "Bancos_id_seq" OWNED BY bancos.id;
            public       eureka    false    171            �            1259    364234    accionistas    TABLE     �   CREATE TABLE accionistas (
    id integer NOT NULL,
    persona_natural_id integer NOT NULL,
    contratista_id integer NOT NULL
);
    DROP TABLE public.accionistas;
       public         eureka    false    6            B	           0    0    TABLE accionistas    COMMENT     A   COMMENT ON TABLE accionistas IS 'Accionistas de la contratista';
            public       eureka    false    172            C	           0    0    COLUMN accionistas.id    COMMENT     6   COMMENT ON COLUMN accionistas.id IS 'Clave primaria';
            public       eureka    false    172            D	           0    0 %   COLUMN accionistas.persona_natural_id    COMMENT     h   COMMENT ON COLUMN accionistas.persona_natural_id IS 'Clave foranea a "id" en la tabla persona_natural';
            public       eureka    false    172            E	           0    0 !   COLUMN accionistas.contratista_id    COMMENT     a   COMMENT ON COLUMN accionistas.contratista_id IS 'Clave foranea a "id" en la tabla contratistas';
            public       eureka    false    172            �            1259    364237    accionistas_id_seq    SEQUENCE     t   CREATE SEQUENCE accionistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.accionistas_id_seq;
       public       eureka    false    6    172            F	           0    0    accionistas_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE accionistas_id_seq OWNED BY accionistas.id;
            public       eureka    false    173            �            1259    364247    bancos_contratistas    TABLE     �   CREATE TABLE bancos_contratistas (
    id integer NOT NULL,
    banco_id integer NOT NULL,
    contratista_id integer NOT NULL,
    num_cuenta character varying(150),
    ano date,
    activo boolean DEFAULT true
);
 '   DROP TABLE public.bancos_contratistas;
       public         eureka    false    6            G	           0    0    COLUMN bancos_contratistas.id    COMMENT     >   COMMENT ON COLUMN bancos_contratistas.id IS 'Clave primaria';
            public       eureka    false    174            H	           0    0 #   COLUMN bancos_contratistas.banco_id    COMMENT     T   COMMENT ON COLUMN bancos_contratistas.banco_id IS 'Clave foranea a la tabla Banco';
            public       eureka    false    174            I	           0    0 )   COLUMN bancos_contratistas.contratista_id    COMMENT     `   COMMENT ON COLUMN bancos_contratistas.contratista_id IS 'Clave foranea a la tabla Contratista';
            public       eureka    false    174            J	           0    0 %   COLUMN bancos_contratistas.num_cuenta    COMMENT     R   COMMENT ON COLUMN bancos_contratistas.num_cuenta IS 'Número de cuenta bancaria';
            public       eureka    false    174            K	           0    0    COLUMN bancos_contratistas.ano    COMMENT     =   COMMENT ON COLUMN bancos_contratistas.ano IS 'Año cargado';
            public       eureka    false    174            L	           0    0 !   COLUMN bancos_contratistas.activo    COMMENT     `   COMMENT ON COLUMN bancos_contratistas.activo IS 'Si el registro se encuentra habilitado o no.';
            public       eureka    false    174            �            1259    364250 &   bancos_contratistas_contratista_id_seq    SEQUENCE     �   CREATE SEQUENCE bancos_contratistas_contratista_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 =   DROP SEQUENCE public.bancos_contratistas_contratista_id_seq;
       public       eureka    false    174    6            M	           0    0 &   bancos_contratistas_contratista_id_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE bancos_contratistas_contratista_id_seq OWNED BY bancos_contratistas.contratista_id;
            public       eureka    false    175            �            1259    364252    bancos_contratistas_id_seq    SEQUENCE     |   CREATE SEQUENCE bancos_contratistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.bancos_contratistas_id_seq;
       public       eureka    false    174    6            N	           0    0    bancos_contratistas_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE bancos_contratistas_id_seq OWNED BY bancos_contratistas.id;
            public       eureka    false    176            �            1259    364259    clientes    TABLE     �   CREATE TABLE clientes (
    id integer NOT NULL,
    nombre character varying(255),
    rif character varying(10) NOT NULL,
    publico boolean NOT NULL,
    contratista_id integer NOT NULL
);
    DROP TABLE public.clientes;
       public         eureka    false    6            O	           0    0    COLUMN clientes.rif    COMMENT     5   COMMENT ON COLUMN clientes.rif IS 'RIF del cliente';
            public       eureka    false    177            P	           0    0    COLUMN clientes.publico    COMMENT     C   COMMENT ON COLUMN clientes.publico IS 'Sector público o privado';
            public       eureka    false    177            Q	           0    0    COLUMN clientes.contratista_id    COMMENT     u   COMMENT ON COLUMN clientes.contratista_id IS 'FK_contratista:id para indicar a que contratista pertence el cliente';
            public       eureka    false    177            �            1259    364262    clientes_id_seq    SEQUENCE     q   CREATE SEQUENCE clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.clientes_id_seq;
       public       eureka    false    177    6            R	           0    0    clientes_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE clientes_id_seq OWNED BY clientes.id;
            public       eureka    false    178            �            1259    364264    contratistas    TABLE     X   CREATE TABLE contratistas (
    id integer NOT NULL,
    empresa_id integer NOT NULL
);
     DROP TABLE public.contratistas;
       public         eureka    false    6            S	           0    0    COLUMN contratistas.id    COMMENT     7   COMMENT ON COLUMN contratistas.id IS 'Clave primaria';
            public       eureka    false    179            T	           0    0    COLUMN contratistas.empresa_id    COMMENT     S   COMMENT ON COLUMN contratistas.empresa_id IS 'Empresa la cual es una contratista';
            public       eureka    false    179            �            1259    364267    contratistas_id_seq    SEQUENCE     u   CREATE SEQUENCE contratistas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.contratistas_id_seq;
       public       eureka    false    179    6            U	           0    0    contratistas_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE contratistas_id_seq OWNED BY contratistas.id;
            public       eureka    false    180            �            1259    373492    cuentas    TABLE     ^   CREATE TABLE cuentas (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL
);
    DROP TABLE public.cuentas;
       public         eureka    false    6            V	           0    0    TABLE cuentas    COMMENT     Y   COMMENT ON TABLE cuentas IS 'Tabla que relaciona una cuenta con un identificador unico';
            public       eureka    false    228            W	           0    0    COLUMN cuentas.id    COMMENT     2   COMMENT ON COLUMN cuentas.id IS 'Clave primaria';
            public       eureka    false    228            X	           0    0    COLUMN cuentas.nombre    COMMENT     ;   COMMENT ON COLUMN cuentas.nombre IS 'Nombre de la cuenta';
            public       eureka    false    228            �            1259    364975    cuentas_cobrar_sprivpub    TABLE     y  CREATE TABLE cuentas_cobrar_sprivpub (
    id integer NOT NULL,
    venta boolean,
    servicio boolean,
    obras boolean,
    num_contrato_factura character varying(255) NOT NULL,
    monto_contrato_f numeric(38,6) NOT NULL,
    procentaje_a integer,
    plazo_contrato integer,
    contatista_id integer NOT NULL,
    ano date DEFAULT now(),
    tipo_cuenta tipo_cuentas
);
 +   DROP TABLE public.cuentas_cobrar_sprivpub;
       public         eureka    false    719    6            Y	           0    0    TABLE cuentas_cobrar_sprivpub    COMMENT     S   COMMENT ON TABLE cuentas_cobrar_sprivpub IS 'Tabla perteneciente a la cuenta B-1';
            public       eureka    false    220            Z	           0    0 !   COLUMN cuentas_cobrar_sprivpub.id    COMMENT     B   COMMENT ON COLUMN cuentas_cobrar_sprivpub.id IS 'Clave primaria';
            public       eureka    false    220            [	           0    0 $   COLUMN cuentas_cobrar_sprivpub.venta    COMMENT     M   COMMENT ON COLUMN cuentas_cobrar_sprivpub.venta IS 'Tipo de concepto venta';
            public       eureka    false    220            \	           0    0 '   COLUMN cuentas_cobrar_sprivpub.servicio    COMMENT     S   COMMENT ON COLUMN cuentas_cobrar_sprivpub.servicio IS 'Tipo de concepto servicio';
            public       eureka    false    220            ]	           0    0 $   COLUMN cuentas_cobrar_sprivpub.obras    COMMENT     M   COMMENT ON COLUMN cuentas_cobrar_sprivpub.obras IS 'Tipo de concepto obras';
            public       eureka    false    220            ^	           0    0 /   COLUMN cuentas_cobrar_sprivpub.monto_contrato_f    COMMENT     e   COMMENT ON COLUMN cuentas_cobrar_sprivpub.monto_contrato_f IS 'Monto del contrato o de la factura.';
            public       eureka    false    220            _	           0    0 +   COLUMN cuentas_cobrar_sprivpub.procentaje_a    COMMENT     _   COMMENT ON COLUMN cuentas_cobrar_sprivpub.procentaje_a IS 'Porcentaje de avance del Concepto';
            public       eureka    false    220            `	           0    0 -   COLUMN cuentas_cobrar_sprivpub.plazo_contrato    COMMENT     �   COMMENT ON COLUMN cuentas_cobrar_sprivpub.plazo_contrato IS 'Plazo del contrato relacionado con el concepto, expresado en meses.';
            public       eureka    false    220            a	           0    0 ,   COLUMN cuentas_cobrar_sprivpub.contatista_id    COMMENT     �   COMMENT ON COLUMN cuentas_cobrar_sprivpub.contatista_id IS 'FK para id, lograr mantener a que contratista le pertence la cuenta por cobrar del sector publico';
            public       eureka    false    220            b	           0    0 *   COLUMN cuentas_cobrar_sprivpub.tipo_cuenta    COMMENT     �   COMMENT ON COLUMN cuentas_cobrar_sprivpub.tipo_cuenta IS 'Si la entrada representa una cuenta por cobrar para el sector publico o privado';
            public       eureka    false    220            �            1259    364973    cuentas_cobrar_spri_id_seq    SEQUENCE     |   CREATE SEQUENCE cuentas_cobrar_spri_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.cuentas_cobrar_spri_id_seq;
       public       eureka    false    6    220            c	           0    0    cuentas_cobrar_spri_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE cuentas_cobrar_spri_id_seq OWNED BY cuentas_cobrar_sprivpub.id;
            public       eureka    false    219            �            1259    373490    cuentas_id_seq    SEQUENCE     p   CREATE SEQUENCE cuentas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.cuentas_id_seq;
       public       eureka    false    228    6            d	           0    0    cuentas_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE cuentas_id_seq OWNED BY cuentas.id;
            public       eureka    false    227            �            1259    364292    otras_cuentas_cobrar    TABLE     �  CREATE TABLE otras_cuentas_cobrar (
    id integer NOT NULL,
    tipo_deudor_id integer,
    nombre character varying(255) NOT NULL,
    origen character varying(255) NOT NULL,
    fecha time without time zone NOT NULL,
    garantia character varying(255) NOT NULL,
    plazo character varying(255) NOT NULL,
    ano date NOT NULL,
    contratista_id integer NOT NULL,
    activo boolean DEFAULT true
);
 (   DROP TABLE public.otras_cuentas_cobrar;
       public         eureka    false    6            e	           0    0    COLUMN otras_cuentas_cobrar.id    COMMENT     ?   COMMENT ON COLUMN otras_cuentas_cobrar.id IS 'Clave primaria';
            public       eureka    false    181            f	           0    0 *   COLUMN otras_cuentas_cobrar.tipo_deudor_id    COMMENT     g   COMMENT ON COLUMN otras_cuentas_cobrar.tipo_deudor_id IS 'FK:id para verificar que tipo de deudor es';
            public       eureka    false    181            g	           0    0 *   COLUMN otras_cuentas_cobrar.contratista_id    COMMENT     c   COMMENT ON COLUMN otras_cuentas_cobrar.contratista_id IS 'Clave foránea a la tabla Contratistas';
            public       eureka    false    181            h	           0    0 "   COLUMN otras_cuentas_cobrar.activo    COMMENT     X   COMMENT ON COLUMN otras_cuentas_cobrar.activo IS 'Si el registro esta habilitado o no';
            public       eureka    false    181            �            1259    364298    cuentas_por_cobrar_id_seq    SEQUENCE     {   CREATE SEQUENCE cuentas_por_cobrar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.cuentas_por_cobrar_id_seq;
       public       eureka    false    181    6            i	           0    0    cuentas_por_cobrar_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE cuentas_por_cobrar_id_seq OWNED BY otras_cuentas_cobrar.id;
            public       eureka    false    182            �            1259    364305 
   directores    TABLE     �   CREATE TABLE directores (
    id integer NOT NULL,
    persona_natural_id integer NOT NULL,
    contratista_id integer NOT NULL,
    miembro_junta boolean DEFAULT false NOT NULL
);
    DROP TABLE public.directores;
       public         eureka    false    6            j	           0    0    TABLE directores    COMMENT     P   COMMENT ON TABLE directores IS 'Directores Administradores de una contratista';
            public       eureka    false    183            k	           0    0    COLUMN directores.id    COMMENT     5   COMMENT ON COLUMN directores.id IS 'Clave primaria';
            public       eureka    false    183            l	           0    0 $   COLUMN directores.persona_natural_id    COMMENT     F   COMMENT ON COLUMN directores.persona_natural_id IS 'Persona natural';
            public       eureka    false    183            m	           0    0     COLUMN directores.contratista_id    COMMENT     >   COMMENT ON COLUMN directores.contratista_id IS 'Contratista';
            public       eureka    false    183            n	           0    0    COLUMN directores.miembro_junta    COMMENT     L   COMMENT ON COLUMN directores.miembro_junta IS 'Miembro de junta directiva';
            public       eureka    false    183            �            1259    364309    directores_id_seq    SEQUENCE     s   CREATE SEQUENCE directores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.directores_id_seq;
       public       eureka    false    183    6            o	           0    0    directores_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE directores_id_seq OWNED BY directores.id;
            public       eureka    false    184            �            1259    364311    efectivo_banco    TABLE     �  CREATE TABLE efectivo_banco (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    banco_id integer NOT NULL,
    saldo_banco numeric(38,6) NOT NULL,
    depos_transito numeric(38,6) NOT NULL,
    che_transito numeric(38,6) NOT NULL,
    nd_contabilizadas numeric(38,6) NOT NULL,
    nc_contabilizadas numeric(38,6) NOT NULL,
    ano date NOT NULL,
    activo boolean DEFAULT true
);
 "   DROP TABLE public.efectivo_banco;
       public         eureka    false    6            p	           0    0    COLUMN efectivo_banco.id    COMMENT     9   COMMENT ON COLUMN efectivo_banco.id IS 'Clave primaria';
            public       eureka    false    185            q	           0    0 $   COLUMN efectivo_banco.contratista_id    COMMENT     \   COMMENT ON COLUMN efectivo_banco.contratista_id IS 'Clave foranea a la tabla Contratistas';
            public       eureka    false    185            r	           0    0    COLUMN efectivo_banco.banco_id    COMMENT     P   COMMENT ON COLUMN efectivo_banco.banco_id IS 'Clave primaria a la tabla Banco';
            public       eureka    false    185            s	           0    0 !   COLUMN efectivo_banco.saldo_banco    COMMENT     G   COMMENT ON COLUMN efectivo_banco.saldo_banco IS 'Saldo según bancos';
            public       eureka    false    185            t	           0    0 $   COLUMN efectivo_banco.depos_transito    COMMENT     L   COMMENT ON COLUMN efectivo_banco.depos_transito IS 'Depositos en transito';
            public       eureka    false    185            u	           0    0 "   COLUMN efectivo_banco.che_transito    COMMENT     I   COMMENT ON COLUMN efectivo_banco.che_transito IS 'Cheques en tránsito';
            public       eureka    false    185            v	           0    0 '   COLUMN efectivo_banco.nd_contabilizadas    COMMENT     Y   COMMENT ON COLUMN efectivo_banco.nd_contabilizadas IS 'ND no contabilizadas errores/DB';
            public       eureka    false    185            w	           0    0 '   COLUMN efectivo_banco.nc_contabilizadas    COMMENT     Y   COMMENT ON COLUMN efectivo_banco.nc_contabilizadas IS 'NC no contabilizadas errores/Cr';
            public       eureka    false    185            x	           0    0    COLUMN efectivo_banco.activo    COMMENT     R   COMMENT ON COLUMN efectivo_banco.activo IS 'Si el registro esta habilitado o no';
            public       eureka    false    185            �            1259    364314    efectivo_banco_id_seq    SEQUENCE     w   CREATE SEQUENCE efectivo_banco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.efectivo_banco_id_seq;
       public       eureka    false    6    185            y	           0    0    efectivo_banco_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE efectivo_banco_id_seq OWNED BY efectivo_banco.id;
            public       eureka    false    186            �            1259    364316    efectivo_caja    TABLE     �   CREATE TABLE efectivo_caja (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    ano date NOT NULL,
    tipo enum_caja NOT NULL,
    tipo_caja_id integer NOT NULL,
    activo boolean DEFAULT true
);
 !   DROP TABLE public.efectivo_caja;
       public         eureka    false    6    575            z	           0    0    COLUMN efectivo_caja.id    COMMENT     8   COMMENT ON COLUMN efectivo_caja.id IS 'Clave primaria';
            public       eureka    false    187            {	           0    0 #   COLUMN efectivo_caja.contratista_id    COMMENT     [   COMMENT ON COLUMN efectivo_caja.contratista_id IS 'Clave foranea a la tabla Contratistas';
            public       eureka    false    187            |	           0    0    COLUMN efectivo_caja.tipo    COMMENT     ;   COMMENT ON COLUMN efectivo_caja.tipo IS 'Caja/Caja chica';
            public       eureka    false    187            }	           0    0 !   COLUMN efectivo_caja.tipo_caja_id    COMMENT     V   COMMENT ON COLUMN efectivo_caja.tipo_caja_id IS 'Clave foranea a la tabla tipo_caja';
            public       eureka    false    187            ~	           0    0    COLUMN efectivo_caja.activo    COMMENT     Q   COMMENT ON COLUMN efectivo_caja.activo IS 'Si el registro esta habilitado o no';
            public       eureka    false    187            �            1259    364319    efectivo_caja_id_seq    SEQUENCE     v   CREATE SEQUENCE efectivo_caja_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.efectivo_caja_id_seq;
       public       eureka    false    187    6            	           0    0    efectivo_caja_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE efectivo_caja_id_seq OWNED BY efectivo_caja.id;
            public       eureka    false    188            �            1259    364326    personas_juridicas    TABLE     �   CREATE TABLE personas_juridicas (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    rif character varying(255) NOT NULL
);
 &   DROP TABLE public.personas_juridicas;
       public         eureka    false    6            �	           0    0    TABLE personas_juridicas    COMMENT     =   COMMENT ON TABLE personas_juridicas IS 'Personas Juridicas';
            public       eureka    false    189            �            1259    364332    empresas_id_seq    SEQUENCE     q   CREATE SEQUENCE empresas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.empresas_id_seq;
       public       eureka    false    189    6            �	           0    0    empresas_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE empresas_id_seq OWNED BY personas_juridicas.id;
            public       eureka    false    190            �            1259    364334    empresas_relacionadas    TABLE     �   CREATE TABLE empresas_relacionadas (
    id integer NOT NULL,
    empresa_id integer NOT NULL,
    contratista_id integer NOT NULL,
    otras_cuentas_pagar_id integer NOT NULL,
    participacion numeric(38,6)
);
 )   DROP TABLE public.empresas_relacionadas;
       public         eureka    false    6            �	           0    0    COLUMN empresas_relacionadas.id    COMMENT     @   COMMENT ON COLUMN empresas_relacionadas.id IS 'Clave primaria';
            public       eureka    false    191            �	           0    0 '   COLUMN empresas_relacionadas.empresa_id    COMMENT     M   COMMENT ON COLUMN empresas_relacionadas.empresa_id IS 'Empresa relacionada';
            public       eureka    false    191            �	           0    0 +   COLUMN empresas_relacionadas.contratista_id    COMMENT     Q   COMMENT ON COLUMN empresas_relacionadas.contratista_id IS 'Empresa contratista';
            public       eureka    false    191            �	           0    0 3   COLUMN empresas_relacionadas.otras_cuentas_pagar_id    COMMENT     s   COMMENT ON COLUMN empresas_relacionadas.otras_cuentas_pagar_id IS 'Clave foránea a la tabla otras_cuentas_pagar';
            public       eureka    false    191            �	           0    0 *   COLUMN empresas_relacionadas.participacion    COMMENT     �   COMMENT ON COLUMN empresas_relacionadas.participacion IS 'Porcentaje de acciones o participacion que tiene la empresa con la contratista.';
            public       eureka    false    191            �            1259    364337    empresas_relacionadas_id_seq    SEQUENCE     ~   CREATE SEQUENCE empresas_relacionadas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.empresas_relacionadas_id_seq;
       public       eureka    false    6    191            �	           0    0    empresas_relacionadas_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE empresas_relacionadas_id_seq OWNED BY empresas_relacionadas.id;
            public       eureka    false    192            �            1259    364344    gastos_pag_ant    TABLE     g  CREATE TABLE gastos_pag_ant (
    id integer NOT NULL,
    gastos enum_gastos NOT NULL,
    ref_proveedor_ppal character varying(255) NOT NULL,
    saldo_per_ant numeric(38,6) NOT NULL,
    importe_contratado_per numeric(38,6) NOT NULL,
    reintegro_apli_amorti numeric(38,6) NOT NULL,
    saldo_contabilidad numeric(38,6) NOT NULL,
    ano date NOT NULL
);
 "   DROP TABLE public.gastos_pag_ant;
       public         eureka    false    578    6            �	           0    0    COLUMN gastos_pag_ant.id    COMMENT     9   COMMENT ON COLUMN gastos_pag_ant.id IS 'Clave primaria';
            public       eureka    false    193            �	           0    0    COLUMN gastos_pag_ant.gastos    COMMENT     L   COMMENT ON COLUMN gastos_pag_ant.gastos IS 'Gastos pagados por anticipado';
            public       eureka    false    193            �	           0    0 (   COLUMN gastos_pag_ant.ref_proveedor_ppal    COMMENT     Y   COMMENT ON COLUMN gastos_pag_ant.ref_proveedor_ppal IS 'Referencia Proveedor Principal';
            public       eureka    false    193            �	           0    0 #   COLUMN gastos_pag_ant.saldo_per_ant    COMMENT     Q   COMMENT ON COLUMN gastos_pag_ant.saldo_per_ant IS 'Saldo del Período Anterior';
            public       eureka    false    193            �	           0    0 ,   COLUMN gastos_pag_ant.importe_contratado_per    COMMENT     `   COMMENT ON COLUMN gastos_pag_ant.importe_contratado_per IS 'Importe Contratado en el período';
            public       eureka    false    193            �	           0    0 +   COLUMN gastos_pag_ant.reintegro_apli_amorti    COMMENT     c   COMMENT ON COLUMN gastos_pag_ant.reintegro_apli_amorti IS 'Reintegro Aplicación o Amortización';
            public       eureka    false    193            �	           0    0 (   COLUMN gastos_pag_ant.saldo_contabilidad    COMMENT     T   COMMENT ON COLUMN gastos_pag_ant.saldo_contabilidad IS 'Saldo según Contabilidad';
            public       eureka    false    193            �            1259    364347    gastos_pag_ant_id_seq    SEQUENCE     w   CREATE SEQUENCE gastos_pag_ant_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.gastos_pag_ant_id_seq;
       public       eureka    false    193    6            �	           0    0    gastos_pag_ant_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE gastos_pag_ant_id_seq OWNED BY gastos_pag_ant.id;
            public       eureka    false    194            �            1259    364940    inpc    TABLE     �   CREATE TABLE inpc (
    id integer NOT NULL,
    mes integer NOT NULL,
    indice numeric(38,6) NOT NULL,
    ano integer NOT NULL
);
    DROP TABLE public.inpc;
       public         eureka    false    6            �	           0    0 
   TABLE inpc    COMMENT     l   COMMENT ON TABLE inpc IS 'Tabla que contiene el indice nacional de precio y consumidor emitida por el BCV';
            public       eureka    false    216            �	           0    0    COLUMN inpc.id    COMMENT     /   COMMENT ON COLUMN inpc.id IS 'Clave primaria';
            public       eureka    false    216            �	           0    0    COLUMN inpc.mes    COMMENT     /   COMMENT ON COLUMN inpc.mes IS 'Mes de 1 a 12';
            public       eureka    false    216            �	           0    0    COLUMN inpc.indice    COMMENT     A   COMMENT ON COLUMN inpc.indice IS 'Indice de inflación por mes';
            public       eureka    false    216            �            1259    364938    inpc_id_seq    SEQUENCE     m   CREATE SEQUENCE inpc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.inpc_id_seq;
       public       eureka    false    6    216            �	           0    0    inpc_id_seq    SEQUENCE OWNED BY     -   ALTER SEQUENCE inpc_id_seq OWNED BY inpc.id;
            public       eureka    false    215            �            1259    364364    inventarios    TABLE     �  CREATE TABLE inventarios (
    id integer NOT NULL,
    tec_med_costo character varying(255) NOT NULL,
    for_cal_costo character varying(255) NOT NULL,
    costo_adquisicion numeric(38,6) NOT NULL,
    ajuste_inflacion character varying(255) NOT NULL,
    reverso_deterioro character varying(255) NOT NULL,
    saldo_contabilidad numeric(38,6) NOT NULL,
    inventario enum_inventario NOT NULL
);
    DROP TABLE public.inventarios;
       public         eureka    false    581    6            �	           0    0     COLUMN inventarios.tec_med_costo    COMMENT     R   COMMENT ON COLUMN inventarios.tec_med_costo IS 'Técnica de Medición del Costo';
            public       eureka    false    195            �	           0    0     COLUMN inventarios.for_cal_costo    COMMENT     Q   COMMENT ON COLUMN inventarios.for_cal_costo IS 'Fórmula de cálculo del Costo';
            public       eureka    false    195            �	           0    0 $   COLUMN inventarios.costo_adquisicion    COMMENT     Y   COMMENT ON COLUMN inventarios.costo_adquisicion IS 'Costo de adqusición o producción';
            public       eureka    false    195            �	           0    0 #   COLUMN inventarios.ajuste_inflacion    COMMENT     J   COMMENT ON COLUMN inventarios.ajuste_inflacion IS 'Ajuste por inflacion';
            public       eureka    false    195            �	           0    0 $   COLUMN inventarios.reverso_deterioro    COMMENT     X   COMMENT ON COLUMN inventarios.reverso_deterioro IS 'Reverso del deterioro (Deterioro)';
            public       eureka    false    195            �	           0    0 %   COLUMN inventarios.saldo_contabilidad    COMMENT     Q   COMMENT ON COLUMN inventarios.saldo_contabilidad IS 'Saldo según Contabilidad';
            public       eureka    false    195            �	           0    0    COLUMN inventarios.inventario    COMMENT     :   COMMENT ON COLUMN inventarios.inventario IS 'Inventario';
            public       eureka    false    195            �            1259    364370    inventario_id_seq    SEQUENCE     s   CREATE SEQUENCE inventario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.inventario_id_seq;
       public       eureka    false    195    6            �	           0    0    inventario_id_seq    SEQUENCE OWNED BY     :   ALTER SEQUENCE inventario_id_seq OWNED BY inventarios.id;
            public       eureka    false    196            �            1259    365019    inventarios_c    TABLE     d  CREATE TABLE inventarios_c (
    id integer NOT NULL,
    tecnica_medicion character varying(255) NOT NULL,
    formula_calculo character varying(255) NOT NULL,
    costo_adquisicion numeric(38,6) NOT NULL,
    ajuste_inflacion numeric(38,6) NOT NULL,
    reservo_deterioro numeric(38,6),
    contratista_id integer NOT NULL,
    ano date DEFAULT now()
);
 !   DROP TABLE public.inventarios_c;
       public         eureka    false    6            �	           0    0    TABLE inventarios_c    COMMENT     r   COMMENT ON TABLE inventarios_c IS 'Tabla que mantiene las entradas de los inventarios segun su cada contratista';
            public       eureka    false    224            �	           0    0    COLUMN inventarios_c.id    COMMENT     8   COMMENT ON COLUMN inventarios_c.id IS 'Clave primaria';
            public       eureka    false    224            �	           0    0 %   COLUMN inventarios_c.tecnica_medicion    COMMENT     V   COMMENT ON COLUMN inventarios_c.tecnica_medicion IS 'Técnica de medicion del costo';
            public       eureka    false    224            �	           0    0 $   COLUMN inventarios_c.formula_calculo    COMMENT     U   COMMENT ON COLUMN inventarios_c.formula_calculo IS 'Fórmula de cálculo del costo';
            public       eureka    false    224            �	           0    0 &   COLUMN inventarios_c.costo_adquisicion    COMMENT     \   COMMENT ON COLUMN inventarios_c.costo_adquisicion IS 'Costo de adquisición o producción';
            public       eureka    false    224            �	           0    0 %   COLUMN inventarios_c.ajuste_inflacion    COMMENT     M   COMMENT ON COLUMN inventarios_c.ajuste_inflacion IS 'Ajuste por inflación';
            public       eureka    false    224            �	           0    0 &   COLUMN inventarios_c.reservo_deterioro    COMMENT     B   COMMENT ON COLUMN inventarios_c.reservo_deterioro IS 'Deterioro';
            public       eureka    false    224            �	           0    0 #   COLUMN inventarios_c.contratista_id    COMMENT     �   COMMENT ON COLUMN inventarios_c.contratista_id IS 'FK campo id, para mantener relacion de quien es la entrada en el inventario, es decir aque contratista pertence.';
            public       eureka    false    224            �            1259    365017    inventarios_c_id_seq    SEQUENCE     v   CREATE SEQUENCE inventarios_c_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.inventarios_c_id_seq;
       public       eureka    false    6    224            �	           0    0    inventarios_c_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE inventarios_c_id_seq OWNED BY inventarios_c.id;
            public       eureka    false    223            �            1259    364372    inversiones    TABLE     |  CREATE TABLE inversiones (
    id integer NOT NULL,
    banco_id integer NOT NULL,
    costo_adquisicion numeric(38,6) NOT NULL,
    valor_desvalorizacion numeric(38,6) NOT NULL,
    contratista_id integer NOT NULL,
    ano date NOT NULL,
    activo boolean DEFAULT true,
    plazo integer NOT NULL,
    tasa_interes numeric(38,6) NOT NULL,
    tipo_inversion integer NOT NULL
);
    DROP TABLE public.inversiones;
       public         eureka    false    6            �	           0    0    COLUMN inversiones.banco_id    COMMENT     M   COMMENT ON COLUMN inversiones.banco_id IS 'Clave foranea a la tabla Bancos';
            public       eureka    false    197            �	           0    0 (   COLUMN inversiones.valor_desvalorizacion    COMMENT     Y   COMMENT ON COLUMN inversiones.valor_desvalorizacion IS 'Valorización desvalorización';
            public       eureka    false    197            �	           0    0 !   COLUMN inversiones.contratista_id    COMMENT     Y   COMMENT ON COLUMN inversiones.contratista_id IS 'Clave foranea a la tabla Contratistas';
            public       eureka    false    197            �	           0    0    COLUMN inversiones.activo    COMMENT     O   COMMENT ON COLUMN inversiones.activo IS 'Si el registro esta habilitado o no';
            public       eureka    false    197            �	           0    0    COLUMN inversiones.plazo    COMMENT     d   COMMENT ON COLUMN inversiones.plazo IS 'Plazo de la inversion representados del 1 al 12 (POR MES)';
            public       eureka    false    197            �	           0    0 !   COLUMN inversiones.tipo_inversion    COMMENT     �   COMMENT ON COLUMN inversiones.tipo_inversion IS 'FK_tipo_inversion:id para enlazar el tipo de inversion que exista con el contratista';
            public       eureka    false    197            �            1259    364383    inversiones_id_seq    SEQUENCE     t   CREATE SEQUENCE inversiones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.inversiones_id_seq;
       public       eureka    false    6    197            �	           0    0    inversiones_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE inversiones_id_seq OWNED BY inversiones.id;
            public       eureka    false    198            �            1259    364411 	   migration    TABLE     `   CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);
    DROP TABLE public.migration;
       public         eureka    false    6            �            1259    364414    notas_revelatorias    TABLE     �   CREATE TABLE notas_revelatorias (
    id integer NOT NULL,
    nota text NOT NULL,
    usuario_id integer NOT NULL,
    contratista_id integer NOT NULL,
    ano date DEFAULT now(),
    cuenta integer NOT NULL
);
 &   DROP TABLE public.notas_revelatorias;
       public         eureka    false    6            �	           0    0    COLUMN notas_revelatorias.id    COMMENT     =   COMMENT ON COLUMN notas_revelatorias.id IS 'Clave Primaria';
            public       eureka    false    200            �	           0    0    COLUMN notas_revelatorias.nota    COMMENT     T   COMMENT ON COLUMN notas_revelatorias.nota IS 'Descripcion de la nota revelataroia';
            public       eureka    false    200            �	           0    0 $   COLUMN notas_revelatorias.usuario_id    COMMENT     Y   COMMENT ON COLUMN notas_revelatorias.usuario_id IS 'Clave foranea a la tabla Usuarios.';
            public       eureka    false    200            �	           0    0 (   COLUMN notas_revelatorias.contratista_id    COMMENT     `   COMMENT ON COLUMN notas_revelatorias.contratista_id IS 'Clave foranea a la tabla Contratistas';
            public       eureka    false    200            �	           0    0     COLUMN notas_revelatorias.cuenta    COMMENT     |   COMMENT ON COLUMN notas_revelatorias.cuenta IS 'Numero asociado a la cuenta a la cual se va a asociar la nota revelatoria';
            public       eureka    false    200            �            1259    364420    notas_revelatorias_id_seq    SEQUENCE     {   CREATE SEQUENCE notas_revelatorias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.notas_revelatorias_id_seq;
       public       eureka    false    200    6            �	           0    0    notas_revelatorias_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE notas_revelatorias_id_seq OWNED BY notas_revelatorias.id;
            public       eureka    false    201            �            1259    364458    personas_naturales    TABLE     �   CREATE TABLE personas_naturales (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    cedula character varying(50) NOT NULL
);
 &   DROP TABLE public.personas_naturales;
       public         eureka    false    6            �	           0    0    TABLE personas_naturales    COMMENT     �   COMMENT ON TABLE personas_naturales IS 'Toda persona natural que pueda estar registrada en una contratista, ya sea como accionista, empleado, etc.';
            public       eureka    false    202            �	           0    0    COLUMN personas_naturales.id    COMMENT     =   COMMENT ON COLUMN personas_naturales.id IS 'Clave primaria';
            public       eureka    false    202            �	           0    0     COLUMN personas_naturales.nombre    COMMENT     G   COMMENT ON COLUMN personas_naturales.nombre IS 'Nombre de la persona';
            public       eureka    false    202            �	           0    0     COLUMN personas_naturales.cedula    COMMENT     U   COMMENT ON COLUMN personas_naturales.cedula IS 'Cédula de identidad de la persona';
            public       eureka    false    202            �            1259    364461    personas_naturales_id_seq    SEQUENCE     {   CREATE SEQUENCE personas_naturales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.personas_naturales_id_seq;
       public       eureka    false    202    6            �	           0    0    personas_naturales_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE personas_naturales_id_seq OWNED BY personas_naturales.id;
            public       eureka    false    203            �            1259    364983    reps_legales    TABLE     |   CREATE TABLE reps_legales (
    id integer NOT NULL,
    persona_natural_id integer,
    contratista_id integer NOT NULL
);
     DROP TABLE public.reps_legales;
       public         eureka    false    6            �	           0    0    TABLE reps_legales    COMMENT     i   COMMENT ON TABLE reps_legales IS 'Tabla donde se almacenan los representantes legales de l contratista';
            public       eureka    false    222            �	           0    0    COLUMN reps_legales.id    COMMENT     7   COMMENT ON COLUMN reps_legales.id IS 'Clave primaria';
            public       eureka    false    222            �	           0    0 &   COLUMN reps_legales.persona_natural_id    COMMENT     l   COMMENT ON COLUMN reps_legales.persona_natural_id IS 'FK de la persona natural que es representante legal';
            public       eureka    false    222            �	           0    0 "   COLUMN reps_legales.contratista_id    COMMENT     t   COMMENT ON COLUMN reps_legales.contratista_id IS 'FK de la contratista a la cual pertenece el representante legal';
            public       eureka    false    222            �            1259    364981    reps_legales_id_seq    SEQUENCE     u   CREATE SEQUENCE reps_legales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.reps_legales_id_seq;
       public       eureka    false    222    6            �	           0    0    reps_legales_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE reps_legales_id_seq OWNED BY reps_legales.id;
            public       eureka    false    221            �            1259    364919    sustento_conts    TABLE     �   CREATE TABLE sustento_conts (
    id integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    tipo_sustento_id integer NOT NULL,
    contratista_id integer NOT NULL,
    ano date DEFAULT now()
);
 "   DROP TABLE public.sustento_conts;
       public         eureka    false    6            �	           0    0    TABLE sustento_conts    COMMENT     ~   COMMENT ON TABLE sustento_conts IS 'Tabla que contiene la relacion de la cuenta a la que aplica el sustento por contratista';
            public       eureka    false    214            �	           0    0    COLUMN sustento_conts.id    COMMENT     9   COMMENT ON COLUMN sustento_conts.id IS 'Clave primaria';
            public       eureka    false    214            �	           0    0 !   COLUMN sustento_conts.descripcion    COMMENT     �   COMMENT ON COLUMN sustento_conts.descripcion IS 'Descripcion que requiera necesaria por el contratista para explicar el dato clave del sustento';
            public       eureka    false    214            �	           0    0 &   COLUMN sustento_conts.tipo_sustento_id    COMMENT     N   COMMENT ON COLUMN sustento_conts.tipo_sustento_id IS 'FK_tipos_sustentos:id';
            public       eureka    false    214            �	           0    0 $   COLUMN sustento_conts.contratista_id    COMMENT     �   COMMENT ON COLUMN sustento_conts.contratista_id IS 'FK_contratista:id para mantener el historico de los sustentos marcados por el contratista';
            public       eureka    false    214            �            1259    364917    sustento_cont_id_seq    SEQUENCE     v   CREATE SEQUENCE sustento_cont_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.sustento_cont_id_seq;
       public       eureka    false    214    6            �	           0    0    sustento_cont_id_seq    SEQUENCE OWNED BY     @   ALTER SEQUENCE sustento_cont_id_seq OWNED BY sustento_conts.id;
            public       eureka    false    213            �            1259    364494    tipos_cajas    TABLE     �   CREATE TABLE tipos_cajas (
    id integer NOT NULL,
    nombre character varying(255),
    contratista_id integer NOT NULL,
    ano date,
    activo boolean DEFAULT true NOT NULL
);
    DROP TABLE public.tipos_cajas;
       public         eureka    false    6            �	           0    0    TABLE tipos_cajas    COMMENT     A   COMMENT ON TABLE tipos_cajas IS 'Tipo de caja (chica o grande)';
            public       eureka    false    204            �	           0    0    COLUMN tipos_cajas.id    COMMENT     6   COMMENT ON COLUMN tipos_cajas.id IS 'Clave primaria';
            public       eureka    false    204            �	           0    0    COLUMN tipos_cajas.nombre    COMMENT     C   COMMENT ON COLUMN tipos_cajas.nombre IS 'Nombre del tipo de caja';
            public       eureka    false    204            �	           0    0 !   COLUMN tipos_cajas.contratista_id    COMMENT     [   COMMENT ON COLUMN tipos_cajas.contratista_id IS 'Clave foranea a la tabla de Contratista';
            public       eureka    false    204            �	           0    0    COLUMN tipos_cajas.ano    COMMENT     ;   COMMENT ON COLUMN tipos_cajas.ano IS 'Año de la entrada';
            public       eureka    false    204            �	           0    0    COLUMN tipos_cajas.activo    COMMENT     K   COMMENT ON COLUMN tipos_cajas.activo IS 'Si la entrada esta o no activa.';
            public       eureka    false    204            �            1259    364498    tipo_caja_id_seq    SEQUENCE     r   CREATE SEQUENCE tipo_caja_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.tipo_caja_id_seq;
       public       eureka    false    6    204            �	           0    0    tipo_caja_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE tipo_caja_id_seq OWNED BY tipos_cajas.id;
            public       eureka    false    205            �            1259    364500    tipos_deudores    TABLE     �   CREATE TABLE tipos_deudores (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    "descripción" character varying(255) NOT NULL,
    activo boolean DEFAULT true
);
 "   DROP TABLE public.tipos_deudores;
       public         eureka    false    6            �	           0    0    TABLE tipos_deudores    COMMENT     F   COMMENT ON TABLE tipos_deudores IS 'Tipos de deudores de la empresa';
            public       eureka    false    206            �	           0    0    COLUMN tipos_deudores.id    COMMENT     9   COMMENT ON COLUMN tipos_deudores.id IS 'Clave primaria';
            public       eureka    false    206            �	           0    0    COLUMN tipos_deudores.nombre    COMMENT     H   COMMENT ON COLUMN tipos_deudores.nombre IS 'Nombre del tipo de deudor';
            public       eureka    false    206            �	           0    0 $   COLUMN tipos_deudores."descripción"    COMMENT     V   COMMENT ON COLUMN tipos_deudores."descripción" IS 'Descripción del tipo de deudor';
            public       eureka    false    206            �	           0    0    COLUMN tipos_deudores.activo    COMMENT     R   COMMENT ON COLUMN tipos_deudores.activo IS 'Si el registro esta habilitado o no';
            public       eureka    false    206            �            1259    364506    tipos_deudores_id_seq    SEQUENCE     w   CREATE SEQUENCE tipos_deudores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tipos_deudores_id_seq;
       public       eureka    false    206    6            �	           0    0    tipos_deudores_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE tipos_deudores_id_seq OWNED BY tipos_deudores.id;
            public       eureka    false    207            �            1259    364951    tipos_inversiones    TABLE     �   CREATE TABLE tipos_inversiones (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    activo boolean NOT NULL,
    ano date DEFAULT now(),
    descripcion character varying(255)
);
 %   DROP TABLE public.tipos_inversiones;
       public         eureka    false    6            �	           0    0    TABLE tipos_inversiones    COMMENT     z   COMMENT ON TABLE tipos_inversiones IS 'Tabla que contiene todos los tipos de inversiones a colocar por los contratistas';
            public       eureka    false    218            �	           0    0    COLUMN tipos_inversiones.id    COMMENT     <   COMMENT ON COLUMN tipos_inversiones.id IS 'Clave primaria';
            public       eureka    false    218            �	           0    0    COLUMN tipos_inversiones.nombre    COMMENT     R   COMMENT ON COLUMN tipos_inversiones.nombre IS 'Nombre de la inversion a colocar';
            public       eureka    false    218            �	           0    0    COLUMN tipos_inversiones.activo    COMMENT     Q   COMMENT ON COLUMN tipos_inversiones.activo IS 'Si el registro esta o no activo';
            public       eureka    false    218            �	           0    0 $   COLUMN tipos_inversiones.descripcion    COMMENT     �   COMMENT ON COLUMN tipos_inversiones.descripcion IS 'Descripcion en caso de que se requiera mostrar informacion adicional al contratista';
            public       eureka    false    218            �            1259    364949    tipos_inversiones_id_seq    SEQUENCE     z   CREATE SEQUENCE tipos_inversiones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.tipos_inversiones_id_seq;
       public       eureka    false    6    218            �	           0    0    tipos_inversiones_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE tipos_inversiones_id_seq OWNED BY tipos_inversiones.id;
            public       eureka    false    217            �            1259    364909    tipos_sustentos    TABLE     �   CREATE TABLE tipos_sustentos (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    tipo_cuenta character varying(200) NOT NULL,
    activo boolean DEFAULT true,
    ano date DEFAULT now()
);
 #   DROP TABLE public.tipos_sustentos;
       public         eureka    false    6            �	           0    0    TABLE tipos_sustentos    COMMENT     �   COMMENT ON TABLE tipos_sustentos IS 'Tabla donde se encuentran almacenados todos los sustentos que soportan la informacion cargada asociada a su respectiva cuenta.';
            public       eureka    false    212            �	           0    0    COLUMN tipos_sustentos.id    COMMENT     :   COMMENT ON COLUMN tipos_sustentos.id IS 'Clave primaria';
            public       eureka    false    212            �	           0    0    COLUMN tipos_sustentos.nombre    COMMENT     C   COMMENT ON COLUMN tipos_sustentos.nombre IS 'Nombre del sustento';
            public       eureka    false    212            �	           0    0 "   COLUMN tipos_sustentos.tipo_cuenta    COMMENT     _   COMMENT ON COLUMN tipos_sustentos.tipo_cuenta IS 'La cuenta a la cual pertenece el requisito';
            public       eureka    false    212            �	           0    0    COLUMN tipos_sustentos.activo    COMMENT     P   COMMENT ON COLUMN tipos_sustentos.activo IS 'Si el registro esta o no activo.';
            public       eureka    false    212            �            1259    364907    tipos_sustentos_id_seq    SEQUENCE     x   CREATE SEQUENCE tipos_sustentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.tipos_sustentos_id_seq;
       public       eureka    false    212    6            �	           0    0    tipos_sustentos_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE tipos_sustentos_id_seq OWNED BY tipos_sustentos.id;
            public       eureka    false    211            �            1259    364508    user    TABLE     �  CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    auth_key character varying(32) NOT NULL,
    password_hash character varying(255) NOT NULL,
    password_reset_token character varying(255),
    email character varying(255) NOT NULL,
    status smallint DEFAULT 10 NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);
    DROP TABLE public."user";
       public         eureka    false    6            �            1259    364515    user_id_seq    SEQUENCE     m   CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public       eureka    false    6    208            �	           0    0    user_id_seq    SEQUENCE OWNED BY     /   ALTER SEQUENCE user_id_seq OWNED BY "user".id;
            public       eureka    false    209            �            1259    372313    variables_globales    TABLE     �   CREATE TABLE variables_globales (
    id integer NOT NULL,
    contratista_id integer NOT NULL,
    campo character varying(255) NOT NULL,
    cuenta_afectada integer NOT NULL,
    valor character varying(255) NOT NULL,
    ano date DEFAULT now()
);
 &   DROP TABLE public.variables_globales;
       public         postgres    false    6            �	           0    0    TABLE variables_globales    COMMENT     }   COMMENT ON TABLE variables_globales IS 'Tabla que almacena la informacion por contratista de los campos de algunas cuentas';
            public       postgres    false    226            �	           0    0    COLUMN variables_globales.id    COMMENT     =   COMMENT ON COLUMN variables_globales.id IS 'Clave primaria';
            public       postgres    false    226            �	           0    0 (   COLUMN variables_globales.contratista_id    COMMENT     n   COMMENT ON COLUMN variables_globales.contratista_id IS 'FK:id para obtener la variable por cada contratista';
            public       postgres    false    226            �	           0    0    COLUMN variables_globales.campo    COMMENT     R   COMMENT ON COLUMN variables_globales.campo IS 'Campo a relacionar por la cuenta';
            public       postgres    false    226            �	           0    0 )   COLUMN variables_globales.cuenta_afectada    COMMENT     a   COMMENT ON COLUMN variables_globales.cuenta_afectada IS 'Numero del modelo que afecta al campo';
            public       postgres    false    226            �            1259    372311    variables_globales_id_seq    SEQUENCE     {   CREATE SEQUENCE variables_globales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.variables_globales_id_seq;
       public       postgres    false    6    226            �	           0    0    variables_globales_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE variables_globales_id_seq OWNED BY variables_globales.id;
            public       postgres    false    225            �            1259    364517    vs_database_diagrams    TABLE     �   CREATE TABLE vs_database_diagrams (
    name character varying(80),
    diadata text,
    comment character varying(1022),
    preview text,
    lockinfo character varying(80),
    locktime timestamp with time zone,
    version character varying(80)
);
 (   DROP TABLE public.vs_database_diagrams;
       public         eureka    false    6            �           2604    364523    id    DEFAULT     b   ALTER TABLE ONLY accionistas ALTER COLUMN id SET DEFAULT nextval('accionistas_id_seq'::regclass);
 =   ALTER TABLE public.accionistas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    173    172            �           2604    364524    id    DEFAULT     Z   ALTER TABLE ONLY bancos ALTER COLUMN id SET DEFAULT nextval('"Bancos_id_seq"'::regclass);
 8   ALTER TABLE public.bancos ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    171    170            �           2604    364525    id    DEFAULT     r   ALTER TABLE ONLY bancos_contratistas ALTER COLUMN id SET DEFAULT nextval('bancos_contratistas_id_seq'::regclass);
 E   ALTER TABLE public.bancos_contratistas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    176    174            �           2604    364526    contratista_id    DEFAULT     �   ALTER TABLE ONLY bancos_contratistas ALTER COLUMN contratista_id SET DEFAULT nextval('bancos_contratistas_contratista_id_seq'::regclass);
 Q   ALTER TABLE public.bancos_contratistas ALTER COLUMN contratista_id DROP DEFAULT;
       public       eureka    false    175    174            �           2604    364528    id    DEFAULT     \   ALTER TABLE ONLY clientes ALTER COLUMN id SET DEFAULT nextval('clientes_id_seq'::regclass);
 :   ALTER TABLE public.clientes ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    178    177            �           2604    364529    id    DEFAULT     d   ALTER TABLE ONLY contratistas ALTER COLUMN id SET DEFAULT nextval('contratistas_id_seq'::regclass);
 >   ALTER TABLE public.contratistas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    180    179            #           2604    373495    id    DEFAULT     Z   ALTER TABLE ONLY cuentas ALTER COLUMN id SET DEFAULT nextval('cuentas_id_seq'::regclass);
 9   ALTER TABLE public.cuentas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    228    227    228                       2604    364978    id    DEFAULT     v   ALTER TABLE ONLY cuentas_cobrar_sprivpub ALTER COLUMN id SET DEFAULT nextval('cuentas_cobrar_spri_id_seq'::regclass);
 I   ALTER TABLE public.cuentas_cobrar_sprivpub ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    219    220    220                        2604    364535    id    DEFAULT     `   ALTER TABLE ONLY directores ALTER COLUMN id SET DEFAULT nextval('directores_id_seq'::regclass);
 <   ALTER TABLE public.directores ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    184    183                       2604    364536    id    DEFAULT     h   ALTER TABLE ONLY efectivo_banco ALTER COLUMN id SET DEFAULT nextval('efectivo_banco_id_seq'::regclass);
 @   ALTER TABLE public.efectivo_banco ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    186    185                       2604    364537    id    DEFAULT     f   ALTER TABLE ONLY efectivo_caja ALTER COLUMN id SET DEFAULT nextval('efectivo_caja_id_seq'::regclass);
 ?   ALTER TABLE public.efectivo_caja ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    188    187                       2604    364539    id    DEFAULT     v   ALTER TABLE ONLY empresas_relacionadas ALTER COLUMN id SET DEFAULT nextval('empresas_relacionadas_id_seq'::regclass);
 G   ALTER TABLE public.empresas_relacionadas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    192    191                       2604    364541    id    DEFAULT     h   ALTER TABLE ONLY gastos_pag_ant ALTER COLUMN id SET DEFAULT nextval('gastos_pag_ant_id_seq'::regclass);
 @   ALTER TABLE public.gastos_pag_ant ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    194    193                       2604    364943    id    DEFAULT     T   ALTER TABLE ONLY inpc ALTER COLUMN id SET DEFAULT nextval('inpc_id_seq'::regclass);
 6   ALTER TABLE public.inpc ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    216    215    216                       2604    364545    id    DEFAULT     a   ALTER TABLE ONLY inventarios ALTER COLUMN id SET DEFAULT nextval('inventario_id_seq'::regclass);
 =   ALTER TABLE public.inventarios ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    196    195                       2604    365022    id    DEFAULT     f   ALTER TABLE ONLY inventarios_c ALTER COLUMN id SET DEFAULT nextval('inventarios_c_id_seq'::regclass);
 ?   ALTER TABLE public.inventarios_c ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    223    224    224            	           2604    364546    id    DEFAULT     b   ALTER TABLE ONLY inversiones ALTER COLUMN id SET DEFAULT nextval('inversiones_id_seq'::regclass);
 =   ALTER TABLE public.inversiones ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    198    197                       2604    364552    id    DEFAULT     p   ALTER TABLE ONLY notas_revelatorias ALTER COLUMN id SET DEFAULT nextval('notas_revelatorias_id_seq'::regclass);
 D   ALTER TABLE public.notas_revelatorias ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    201    200            �           2604    364555    id    DEFAULT     r   ALTER TABLE ONLY otras_cuentas_cobrar ALTER COLUMN id SET DEFAULT nextval('cuentas_por_cobrar_id_seq'::regclass);
 F   ALTER TABLE public.otras_cuentas_cobrar ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    182    181                       2604    364561    id    DEFAULT     f   ALTER TABLE ONLY personas_juridicas ALTER COLUMN id SET DEFAULT nextval('empresas_id_seq'::regclass);
 D   ALTER TABLE public.personas_juridicas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    190    189                       2604    364562    id    DEFAULT     p   ALTER TABLE ONLY personas_naturales ALTER COLUMN id SET DEFAULT nextval('personas_naturales_id_seq'::regclass);
 D   ALTER TABLE public.personas_naturales ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    203    202                       2604    364986    id    DEFAULT     d   ALTER TABLE ONLY reps_legales ALTER COLUMN id SET DEFAULT nextval('reps_legales_id_seq'::regclass);
 >   ALTER TABLE public.reps_legales ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    221    222    222                       2604    364922    id    DEFAULT     g   ALTER TABLE ONLY sustento_conts ALTER COLUMN id SET DEFAULT nextval('sustento_cont_id_seq'::regclass);
 @   ALTER TABLE public.sustento_conts ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    214    213    214                       2604    364568    id    DEFAULT     `   ALTER TABLE ONLY tipos_cajas ALTER COLUMN id SET DEFAULT nextval('tipo_caja_id_seq'::regclass);
 =   ALTER TABLE public.tipos_cajas ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    205    204                       2604    364569    id    DEFAULT     h   ALTER TABLE ONLY tipos_deudores ALTER COLUMN id SET DEFAULT nextval('tipos_deudores_id_seq'::regclass);
 @   ALTER TABLE public.tipos_deudores ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    207    206                       2604    364954    id    DEFAULT     n   ALTER TABLE ONLY tipos_inversiones ALTER COLUMN id SET DEFAULT nextval('tipos_inversiones_id_seq'::regclass);
 C   ALTER TABLE public.tipos_inversiones ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    218    217    218                       2604    364912    id    DEFAULT     j   ALTER TABLE ONLY tipos_sustentos ALTER COLUMN id SET DEFAULT nextval('tipos_sustentos_id_seq'::regclass);
 A   ALTER TABLE public.tipos_sustentos ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    211    212    212                       2604    364570    id    DEFAULT     V   ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public       eureka    false    209    208            !           2604    372316    id    DEFAULT     p   ALTER TABLE ONLY variables_globales ALTER COLUMN id SET DEFAULT nextval('variables_globales_id_seq'::regclass);
 D   ALTER TABLE public.variables_globales ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    225    226    226            �	           0    0    Bancos_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('"Bancos_id_seq"', 1, false);
            public       eureka    false    171            �          0    364234    accionistas 
   TABLE DATA               F   COPY accionistas (id, persona_natural_id, contratista_id) FROM stdin;
    public       eureka    false    172   J�      �	           0    0    accionistas_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('accionistas_id_seq', 1, false);
            public       eureka    false    173            �          0    364229    bancos 
   TABLE DATA               :   COPY bancos (id, nombre, rif, codigo_sudeban) FROM stdin;
    public       eureka    false    170   g�      �          0    364247    bancos_contratistas 
   TABLE DATA               ]   COPY bancos_contratistas (id, banco_id, contratista_id, num_cuenta, ano, activo) FROM stdin;
    public       eureka    false    174   ��      �	           0    0 &   bancos_contratistas_contratista_id_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('bancos_contratistas_contratista_id_seq', 1, false);
            public       eureka    false    175            �	           0    0    bancos_contratistas_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('bancos_contratistas_id_seq', 1, false);
            public       eureka    false    176            	          0    364259    clientes 
   TABLE DATA               E   COPY clientes (id, nombre, rif, publico, contratista_id) FROM stdin;
    public       eureka    false    177   ��      �	           0    0    clientes_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('clientes_id_seq', 1, false);
            public       eureka    false    178            	          0    364264    contratistas 
   TABLE DATA               /   COPY contratistas (id, empresa_id) FROM stdin;
    public       eureka    false    179   ��      �	           0    0    contratistas_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('contratistas_id_seq', 1, false);
            public       eureka    false    180            4	          0    373492    cuentas 
   TABLE DATA               &   COPY cuentas (id, nombre) FROM stdin;
    public       eureka    false    228   ۳      �	           0    0    cuentas_cobrar_spri_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('cuentas_cobrar_spri_id_seq', 1, false);
            public       eureka    false    219            ,	          0    364975    cuentas_cobrar_sprivpub 
   TABLE DATA               �   COPY cuentas_cobrar_sprivpub (id, venta, servicio, obras, num_contrato_factura, monto_contrato_f, procentaje_a, plazo_contrato, contatista_id, ano, tipo_cuenta) FROM stdin;
    public       eureka    false    220   ��      �	           0    0    cuentas_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('cuentas_id_seq', 1, false);
            public       eureka    false    227            �	           0    0    cuentas_por_cobrar_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('cuentas_por_cobrar_id_seq', 1, false);
            public       eureka    false    182            	          0    364305 
   directores 
   TABLE DATA               T   COPY directores (id, persona_natural_id, contratista_id, miembro_junta) FROM stdin;
    public       eureka    false    183   �      �	           0    0    directores_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('directores_id_seq', 1, false);
            public       eureka    false    184            		          0    364311    efectivo_banco 
   TABLE DATA               �   COPY efectivo_banco (id, contratista_id, banco_id, saldo_banco, depos_transito, che_transito, nd_contabilizadas, nc_contabilizadas, ano, activo) FROM stdin;
    public       eureka    false    185   2�      �	           0    0    efectivo_banco_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('efectivo_banco_id_seq', 1, false);
            public       eureka    false    186            	          0    364316    efectivo_caja 
   TABLE DATA               U   COPY efectivo_caja (id, contratista_id, ano, tipo, tipo_caja_id, activo) FROM stdin;
    public       eureka    false    187   O�      �	           0    0    efectivo_caja_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('efectivo_caja_id_seq', 2, true);
            public       eureka    false    188            �	           0    0    empresas_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('empresas_id_seq', 1, false);
            public       eureka    false    190            	          0    364334    empresas_relacionadas 
   TABLE DATA               o   COPY empresas_relacionadas (id, empresa_id, contratista_id, otras_cuentas_pagar_id, participacion) FROM stdin;
    public       eureka    false    191   l�      �	           0    0    empresas_relacionadas_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('empresas_relacionadas_id_seq', 1, false);
            public       eureka    false    192            	          0    364344    gastos_pag_ant 
   TABLE DATA               �   COPY gastos_pag_ant (id, gastos, ref_proveedor_ppal, saldo_per_ant, importe_contratado_per, reintegro_apli_amorti, saldo_contabilidad, ano) FROM stdin;
    public       eureka    false    193   ��      �	           0    0    gastos_pag_ant_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('gastos_pag_ant_id_seq', 1, false);
            public       eureka    false    194            (	          0    364940    inpc 
   TABLE DATA               -   COPY inpc (id, mes, indice, ano) FROM stdin;
    public       eureka    false    216   ��      �	           0    0    inpc_id_seq    SEQUENCE SET     2   SELECT pg_catalog.setval('inpc_id_seq', 2, true);
            public       eureka    false    215            �	           0    0    inventario_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('inventario_id_seq', 1, false);
            public       eureka    false    196            	          0    364364    inventarios 
   TABLE DATA               �   COPY inventarios (id, tec_med_costo, for_cal_costo, costo_adquisicion, ajuste_inflacion, reverso_deterioro, saldo_contabilidad, inventario) FROM stdin;
    public       eureka    false    195   ô      0	          0    365019    inventarios_c 
   TABLE DATA               �   COPY inventarios_c (id, tecnica_medicion, formula_calculo, costo_adquisicion, ajuste_inflacion, reservo_deterioro, contratista_id, ano) FROM stdin;
    public       eureka    false    224   �      �	           0    0    inventarios_c_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('inventarios_c_id_seq', 1, false);
            public       eureka    false    223            	          0    364372    inversiones 
   TABLE DATA               �   COPY inversiones (id, banco_id, costo_adquisicion, valor_desvalorizacion, contratista_id, ano, activo, plazo, tasa_interes, tipo_inversion) FROM stdin;
    public       eureka    false    197   ��      �	           0    0    inversiones_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('inversiones_id_seq', 1, false);
            public       eureka    false    198            	          0    364411 	   migration 
   TABLE DATA               1   COPY migration (version, apply_time) FROM stdin;
    public       eureka    false    199   �      	          0    364414    notas_revelatorias 
   TABLE DATA               X   COPY notas_revelatorias (id, nota, usuario_id, contratista_id, ano, cuenta) FROM stdin;
    public       eureka    false    200   f�      �	           0    0    notas_revelatorias_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('notas_revelatorias_id_seq', 1, false);
            public       eureka    false    201            	          0    364292    otras_cuentas_cobrar 
   TABLE DATA               �   COPY otras_cuentas_cobrar (id, tipo_deudor_id, nombre, origen, fecha, garantia, plazo, ano, contratista_id, activo) FROM stdin;
    public       eureka    false    181   ��      	          0    364326    personas_juridicas 
   TABLE DATA               6   COPY personas_juridicas (id, nombre, rif) FROM stdin;
    public       eureka    false    189   ��      	          0    364458    personas_naturales 
   TABLE DATA               9   COPY personas_naturales (id, nombre, cedula) FROM stdin;
    public       eureka    false    202   ��      �	           0    0    personas_naturales_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('personas_naturales_id_seq', 1, false);
            public       eureka    false    203            .	          0    364983    reps_legales 
   TABLE DATA               G   COPY reps_legales (id, persona_natural_id, contratista_id) FROM stdin;
    public       eureka    false    222   ڵ      �	           0    0    reps_legales_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('reps_legales_id_seq', 1, false);
            public       eureka    false    221            �	           0    0    sustento_cont_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('sustento_cont_id_seq', 1, false);
            public       eureka    false    213            &	          0    364919    sustento_conts 
   TABLE DATA               Y   COPY sustento_conts (id, descripcion, tipo_sustento_id, contratista_id, ano) FROM stdin;
    public       eureka    false    214   ��      �	           0    0    tipo_caja_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('tipo_caja_id_seq', 1, false);
            public       eureka    false    205            	          0    364494    tipos_cajas 
   TABLE DATA               G   COPY tipos_cajas (id, nombre, contratista_id, ano, activo) FROM stdin;
    public       eureka    false    204   �      	          0    364500    tipos_deudores 
   TABLE DATA               E   COPY tipos_deudores (id, nombre, "descripción", activo) FROM stdin;
    public       eureka    false    206   1�      �	           0    0    tipos_deudores_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('tipos_deudores_id_seq', 1, false);
            public       eureka    false    207            *	          0    364951    tipos_inversiones 
   TABLE DATA               J   COPY tipos_inversiones (id, nombre, activo, ano, descripcion) FROM stdin;
    public       eureka    false    218   N�      �	           0    0    tipos_inversiones_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('tipos_inversiones_id_seq', 1, false);
            public       eureka    false    217            $	          0    364909    tipos_sustentos 
   TABLE DATA               H   COPY tipos_sustentos (id, nombre, tipo_cuenta, activo, ano) FROM stdin;
    public       eureka    false    212   k�      �	           0    0    tipos_sustentos_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('tipos_sustentos_id_seq', 1, false);
            public       eureka    false    211             	          0    364508    user 
   TABLE DATA               }   COPY "user" (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at) FROM stdin;
    public       eureka    false    208   ��      �	           0    0    user_id_seq    SEQUENCE SET     2   SELECT pg_catalog.setval('user_id_seq', 2, true);
            public       eureka    false    209            2	          0    372313    variables_globales 
   TABLE DATA               ]   COPY variables_globales (id, contratista_id, campo, cuenta_afectada, valor, ano) FROM stdin;
    public       postgres    false    226   ��      �	           0    0    variables_globales_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('variables_globales_id_seq', 1, false);
            public       postgres    false    225            "	          0    364517    vs_database_diagrams 
   TABLE DATA               e   COPY vs_database_diagrams (name, diadata, comment, preview, lockinfo, locktime, version) FROM stdin;
    public       eureka    false    210   ӷ      %           2606    364574    Bancos_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY bancos
    ADD CONSTRAINT "Bancos_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.bancos DROP CONSTRAINT "Bancos_pkey";
       public         eureka    false    170    170            '           2606    364576    accionistas_id_key 
   CONSTRAINT     P   ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_id_key UNIQUE (id);
 H   ALTER TABLE ONLY public.accionistas DROP CONSTRAINT accionistas_id_key;
       public         eureka    false    172    172            )           2606    364578    accionistas_pkey 
   CONSTRAINT     s   ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_pkey PRIMARY KEY (persona_natural_id, contratista_id);
 F   ALTER TABLE ONLY public.accionistas DROP CONSTRAINT accionistas_pkey;
       public         eureka    false    172    172    172            +           2606    364582    bancos_contratistas_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.bancos_contratistas DROP CONSTRAINT bancos_contratistas_pkey;
       public         eureka    false    174    174            -           2606    364586    clientes_pk 
   CONSTRAINT     K   ALTER TABLE ONLY clientes
    ADD CONSTRAINT clientes_pk PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_pk;
       public         eureka    false    177    177            0           2606    364588    contratistas_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY contratistas
    ADD CONSTRAINT contratistas_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.contratistas DROP CONSTRAINT contratistas_pkey;
       public         eureka    false    179    179            e           2606    364980    cuentas_cobrar_spri_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY cuentas_cobrar_sprivpub
    ADD CONSTRAINT cuentas_cobrar_spri_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.cuentas_cobrar_sprivpub DROP CONSTRAINT cuentas_cobrar_spri_pkey;
       public         eureka    false    220    220            o           2606    373499    cuentas_nombre_key 
   CONSTRAINT     P   ALTER TABLE ONLY cuentas
    ADD CONSTRAINT cuentas_nombre_key UNIQUE (nombre);
 D   ALTER TABLE ONLY public.cuentas DROP CONSTRAINT cuentas_nombre_key;
       public         eureka    false    228    228            q           2606    373497    cuentas_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY cuentas
    ADD CONSTRAINT cuentas_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.cuentas DROP CONSTRAINT cuentas_pkey;
       public         eureka    false    228    228            2           2606    364600    deudores_pk 
   CONSTRAINT     W   ALTER TABLE ONLY otras_cuentas_cobrar
    ADD CONSTRAINT deudores_pk PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.otras_cuentas_cobrar DROP CONSTRAINT deudores_pk;
       public         eureka    false    181    181            4           2606    364602    directores_id_key 
   CONSTRAINT     N   ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_id_key UNIQUE (id);
 F   ALTER TABLE ONLY public.directores DROP CONSTRAINT directores_id_key;
       public         eureka    false    183    183            6           2606    364604    directores_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_pkey PRIMARY KEY (persona_natural_id, contratista_id);
 D   ALTER TABLE ONLY public.directores DROP CONSTRAINT directores_pkey;
       public         eureka    false    183    183    183            8           2606    364606    efectivo_banco_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY efectivo_banco
    ADD CONSTRAINT efectivo_banco_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.efectivo_banco DROP CONSTRAINT efectivo_banco_pkey;
       public         eureka    false    185    185            :           2606    364608    efectivo_caja_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY efectivo_caja
    ADD CONSTRAINT efectivo_caja_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.efectivo_caja DROP CONSTRAINT efectivo_caja_pkey;
       public         eureka    false    187    187            <           2606    364614    empresas_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY personas_juridicas
    ADD CONSTRAINT empresas_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.personas_juridicas DROP CONSTRAINT empresas_pkey;
       public         eureka    false    189    189            @           2606    364616    empresas_relacionadas_id_key 
   CONSTRAINT     d   ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_id_key UNIQUE (id);
 \   ALTER TABLE ONLY public.empresas_relacionadas DROP CONSTRAINT empresas_relacionadas_id_key;
       public         eureka    false    191    191            B           2606    364618    empresas_relacionadas_pkey 
   CONSTRAINT        ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_pkey PRIMARY KEY (empresa_id, contratista_id);
 Z   ALTER TABLE ONLY public.empresas_relacionadas DROP CONSTRAINT empresas_relacionadas_pkey;
       public         eureka    false    191    191    191            D           2606    364622    gastos_pag_ant_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY gastos_pag_ant
    ADD CONSTRAINT gastos_pag_ant_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.gastos_pag_ant DROP CONSTRAINT gastos_pag_ant_pkey;
       public         eureka    false    193    193            a           2606    364946 	   inpc_pkey 
   CONSTRAINT     E   ALTER TABLE ONLY inpc
    ADD CONSTRAINT inpc_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.inpc DROP CONSTRAINT inpc_pkey;
       public         eureka    false    216    216            F           2606    364630    inventario_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY inventarios
    ADD CONSTRAINT inventario_pkey PRIMARY KEY (id);
 E   ALTER TABLE ONLY public.inventarios DROP CONSTRAINT inventario_pkey;
       public         eureka    false    195    195            k           2606    365028    inventarios_c_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY inventarios_c
    ADD CONSTRAINT inventarios_c_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.inventarios_c DROP CONSTRAINT inventarios_c_pkey;
       public         eureka    false    224    224            I           2606    364634    inversiones_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY inversiones
    ADD CONSTRAINT inversiones_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.inversiones DROP CONSTRAINT inversiones_pkey;
       public         eureka    false    197    197            K           2606    364644    migration_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);
 B   ALTER TABLE ONLY public.migration DROP CONSTRAINT migration_pkey;
       public         eureka    false    199    199            M           2606    364646    notas_revelatorias_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.notas_revelatorias DROP CONSTRAINT notas_revelatorias_pkey;
       public         eureka    false    200    200            >           2606    364662    personas_juridicas_rif_key 
   CONSTRAINT     `   ALTER TABLE ONLY personas_juridicas
    ADD CONSTRAINT personas_juridicas_rif_key UNIQUE (rif);
 W   ALTER TABLE ONLY public.personas_juridicas DROP CONSTRAINT personas_juridicas_rif_key;
       public         eureka    false    189    189            O           2606    364664    personas_naturales_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY personas_naturales
    ADD CONSTRAINT personas_naturales_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.personas_naturales DROP CONSTRAINT personas_naturales_pkey;
       public         eureka    false    202    202            h           2606    364988    reps_legales_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY reps_legales
    ADD CONSTRAINT reps_legales_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.reps_legales DROP CONSTRAINT reps_legales_pkey;
       public         eureka    false    222    222            _           2606    364925    sustento_conts_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY sustento_conts
    ADD CONSTRAINT sustento_conts_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.sustento_conts DROP CONSTRAINT sustento_conts_pkey;
       public         eureka    false    214    214            Q           2606    364678    tipo_caja_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY tipos_cajas
    ADD CONSTRAINT tipo_caja_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.tipos_cajas DROP CONSTRAINT tipo_caja_pkey;
       public         eureka    false    204    204            S           2606    364680    tipos_cajas_nombre_key 
   CONSTRAINT     X   ALTER TABLE ONLY tipos_cajas
    ADD CONSTRAINT tipos_cajas_nombre_key UNIQUE (nombre);
 L   ALTER TABLE ONLY public.tipos_cajas DROP CONSTRAINT tipos_cajas_nombre_key;
       public         eureka    false    204    204            U           2606    364682    tipos_deudores_nombre_key 
   CONSTRAINT     ^   ALTER TABLE ONLY tipos_deudores
    ADD CONSTRAINT tipos_deudores_nombre_key UNIQUE (nombre);
 R   ALTER TABLE ONLY public.tipos_deudores DROP CONSTRAINT tipos_deudores_nombre_key;
       public         eureka    false    206    206            W           2606    364684    tipos_deudores_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY tipos_deudores
    ADD CONSTRAINT tipos_deudores_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.tipos_deudores DROP CONSTRAINT tipos_deudores_pkey;
       public         eureka    false    206    206            c           2606    364960    tipos_inversiones_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY tipos_inversiones
    ADD CONSTRAINT tipos_inversiones_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.tipos_inversiones DROP CONSTRAINT tipos_inversiones_pkey;
       public         eureka    false    218    218            [           2606    364916    tipos_sustentos_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY tipos_sustentos
    ADD CONSTRAINT tipos_sustentos_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.tipos_sustentos DROP CONSTRAINT tipos_sustentos_pkey;
       public         eureka    false    212    212            Y           2606    364686 	   user_pkey 
   CONSTRAINT     G   ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public         eureka    false    208    208            m           2606    372318    variables_globales_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY variables_globales
    ADD CONSTRAINT variables_globales_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.variables_globales DROP CONSTRAINT variables_globales_pkey;
       public         postgres    false    226    226            .           1259    364972    fki_contratista_id    INDEX     J   CREATE INDEX fki_contratista_id ON clientes USING btree (contratista_id);
 &   DROP INDEX public.fki_contratista_id;
       public         eureka    false    177            \           1259    364931    fki_contratista_sustento    INDEX     V   CREATE INDEX fki_contratista_sustento ON sustento_conts USING btree (contratista_id);
 ,   DROP INDEX public.fki_contratista_sustento;
       public         eureka    false    214            f           1259    365009    fki_cuentas_contratista    INDEX     ]   CREATE INDEX fki_cuentas_contratista ON cuentas_cobrar_sprivpub USING btree (contatista_id);
 +   DROP INDEX public.fki_cuentas_contratista;
       public         eureka    false    220            i           1259    365034    fki_inventarios_c_contratista    INDEX     Z   CREATE INDEX fki_inventarios_c_contratista ON inventarios_c USING btree (contratista_id);
 1   DROP INDEX public.fki_inventarios_c_contratista;
       public         eureka    false    224            G           1259    364966    fki_inversiones_tipo    INDEX     O   CREATE INDEX fki_inversiones_tipo ON inversiones USING btree (tipo_inversion);
 (   DROP INDEX public.fki_inversiones_tipo;
       public         eureka    false    197            ]           1259    364937    fki_tipo_sustento_id    INDEX     T   CREATE INDEX fki_tipo_sustento_id ON sustento_conts USING btree (tipo_sustento_id);
 (   DROP INDEX public.fki_tipo_sustento_id;
       public         eureka    false    214            r           2606    364687    accionistas_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 U   ALTER TABLE ONLY public.accionistas DROP CONSTRAINT accionistas_contratista_id_fkey;
       public       eureka    false    2096    172    179            s           2606    364692 #   accionistas_persona_natural_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY accionistas
    ADD CONSTRAINT accionistas_persona_natural_id_fkey FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id);
 Y   ALTER TABLE ONLY public.accionistas DROP CONSTRAINT accionistas_persona_natural_id_fkey;
       public       eureka    false    172    202    2127            t           2606    364697 !   bancos_contratistas_banco_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_banco_id_fkey FOREIGN KEY (banco_id) REFERENCES bancos(id);
 _   ALTER TABLE ONLY public.bancos_contratistas DROP CONSTRAINT bancos_contratistas_banco_id_fkey;
       public       eureka    false    2085    174    170            u           2606    364702 '   bancos_contratistas_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY bancos_contratistas
    ADD CONSTRAINT bancos_contratistas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 e   ALTER TABLE ONLY public.bancos_contratistas DROP CONSTRAINT bancos_contratistas_contratista_id_fkey;
       public       eureka    false    2096    179    174            w           2606    364707    contratistas_empresa_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY contratistas
    ADD CONSTRAINT contratistas_empresa_id_fkey FOREIGN KEY (empresa_id) REFERENCES personas_juridicas(id);
 S   ALTER TABLE ONLY public.contratistas DROP CONSTRAINT contratistas_empresa_id_fkey;
       public       eureka    false    189    179    2108            z           2606    364737    directores_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 S   ALTER TABLE ONLY public.directores DROP CONSTRAINT directores_contratista_id_fkey;
       public       eureka    false    183    2096    179            {           2606    364747 "   directores_persona_natural_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY directores
    ADD CONSTRAINT directores_persona_natural_id_fkey FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id);
 W   ALTER TABLE ONLY public.directores DROP CONSTRAINT directores_persona_natural_id_fkey;
       public       eureka    false    202    183    2127            |           2606    364752    efectivo_banco_banco_id_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY efectivo_banco
    ADD CONSTRAINT efectivo_banco_banco_id_fkey FOREIGN KEY (banco_id) REFERENCES bancos(id);
 U   ALTER TABLE ONLY public.efectivo_banco DROP CONSTRAINT efectivo_banco_banco_id_fkey;
       public       eureka    false    2085    185    170            }           2606    364757 "   efectivo_banco_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY efectivo_banco
    ADD CONSTRAINT efectivo_banco_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE;
 [   ALTER TABLE ONLY public.efectivo_banco DROP CONSTRAINT efectivo_banco_contratista_id_fkey;
       public       eureka    false    2096    179    185            ~           2606    364762 !   efectivo_caja_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY efectivo_caja
    ADD CONSTRAINT efectivo_caja_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE;
 Y   ALTER TABLE ONLY public.efectivo_caja DROP CONSTRAINT efectivo_caja_contratista_id_fkey;
       public       eureka    false    179    187    2096                       2606    364767    efectivo_caja_tipo_caja_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY efectivo_caja
    ADD CONSTRAINT efectivo_caja_tipo_caja_id_fkey FOREIGN KEY (tipo_caja_id) REFERENCES tipos_cajas(id);
 W   ALTER TABLE ONLY public.efectivo_caja DROP CONSTRAINT efectivo_caja_tipo_caja_id_fkey;
       public       eureka    false    187    2129    204            �           2606    364787 )   empresas_relacionadas_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 i   ALTER TABLE ONLY public.empresas_relacionadas DROP CONSTRAINT empresas_relacionadas_contratista_id_fkey;
       public       eureka    false    191    179    2096            �           2606    364792 %   empresas_relacionadas_empresa_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY empresas_relacionadas
    ADD CONSTRAINT empresas_relacionadas_empresa_id_fkey FOREIGN KEY (empresa_id) REFERENCES personas_juridicas(id);
 e   ALTER TABLE ONLY public.empresas_relacionadas DROP CONSTRAINT empresas_relacionadas_empresa_id_fkey;
       public       eureka    false    2108    191    189            v           2606    364967    fk_contratista_id    FK CONSTRAINT     �   ALTER TABLE ONLY clientes
    ADD CONSTRAINT fk_contratista_id FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 D   ALTER TABLE ONLY public.clientes DROP CONSTRAINT fk_contratista_id;
       public       eureka    false    2096    179    177            �           2606    364926    fk_contratista_sustento    FK CONSTRAINT     �   ALTER TABLE ONLY sustento_conts
    ADD CONSTRAINT fk_contratista_sustento FOREIGN KEY (contratista_id) REFERENCES contratistas(id) ON UPDATE CASCADE ON DELETE CASCADE;
 P   ALTER TABLE ONLY public.sustento_conts DROP CONSTRAINT fk_contratista_sustento;
       public       eureka    false    214    2096    179            �           2606    365004    fk_cuentas_contratista    FK CONSTRAINT     �   ALTER TABLE ONLY cuentas_cobrar_sprivpub
    ADD CONSTRAINT fk_cuentas_contratista FOREIGN KEY (contatista_id) REFERENCES contratistas(id);
 X   ALTER TABLE ONLY public.cuentas_cobrar_sprivpub DROP CONSTRAINT fk_cuentas_contratista;
       public       eureka    false    179    2096    220            �           2606    365029    fk_inventarios_c_contratista    FK CONSTRAINT     �   ALTER TABLE ONLY inventarios_c
    ADD CONSTRAINT fk_inventarios_c_contratista FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 T   ALTER TABLE ONLY public.inventarios_c DROP CONSTRAINT fk_inventarios_c_contratista;
       public       eureka    false    224    179    2096            �           2606    364961    fk_inversiones_tipo    FK CONSTRAINT     �   ALTER TABLE ONLY inversiones
    ADD CONSTRAINT fk_inversiones_tipo FOREIGN KEY (tipo_inversion) REFERENCES tipos_inversiones(id) ON UPDATE CASCADE ON DELETE CASCADE;
 I   ALTER TABLE ONLY public.inversiones DROP CONSTRAINT fk_inversiones_tipo;
       public       eureka    false    218    197    2147            �           2606    364932    fk_tipo_sustento_id    FK CONSTRAINT     �   ALTER TABLE ONLY sustento_conts
    ADD CONSTRAINT fk_tipo_sustento_id FOREIGN KEY (tipo_sustento_id) REFERENCES tipos_sustentos(id);
 L   ALTER TABLE ONLY public.sustento_conts DROP CONSTRAINT fk_tipo_sustento_id;
       public       eureka    false    2139    212    214            �           2606    364802    inversiones_banco_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY inversiones
    ADD CONSTRAINT inversiones_banco_id_fkey FOREIGN KEY (banco_id) REFERENCES bancos(id);
 O   ALTER TABLE ONLY public.inversiones DROP CONSTRAINT inversiones_banco_id_fkey;
       public       eureka    false    170    197    2085            �           2606    364807    inversiones_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY inversiones
    ADD CONSTRAINT inversiones_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 U   ALTER TABLE ONLY public.inversiones DROP CONSTRAINT inversiones_contratista_id_fkey;
       public       eureka    false    179    197    2096            �           2606    364812 &   notas_revelatorias_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 c   ALTER TABLE ONLY public.notas_revelatorias DROP CONSTRAINT notas_revelatorias_contratista_id_fkey;
       public       eureka    false    179    200    2096            �           2606    364817 "   notas_revelatorias_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY notas_revelatorias
    ADD CONSTRAINT notas_revelatorias_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES "user"(id);
 _   ALTER TABLE ONLY public.notas_revelatorias DROP CONSTRAINT notas_revelatorias_usuario_id_fkey;
       public       eureka    false    208    200    2137            x           2606    364832 (   otras_cuentas_cobrar_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY otras_cuentas_cobrar
    ADD CONSTRAINT otras_cuentas_cobrar_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 g   ALTER TABLE ONLY public.otras_cuentas_cobrar DROP CONSTRAINT otras_cuentas_cobrar_contratista_id_fkey;
       public       eureka    false    2096    179    181            y           2606    364837 (   otras_cuentas_cobrar_tipo_deudor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY otras_cuentas_cobrar
    ADD CONSTRAINT otras_cuentas_cobrar_tipo_deudor_id_fkey FOREIGN KEY (tipo_deudor_id) REFERENCES tipos_deudores(id);
 g   ALTER TABLE ONLY public.otras_cuentas_cobrar DROP CONSTRAINT otras_cuentas_cobrar_tipo_deudor_id_fkey;
       public       eureka    false    2135    206    181            �           2606    364989     reps_legales_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY reps_legales
    ADD CONSTRAINT reps_legales_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 W   ALTER TABLE ONLY public.reps_legales DROP CONSTRAINT reps_legales_contratista_id_fkey;
       public       eureka    false    222    179    2096            �           2606    364994 $   reps_legales_persona_natural_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY reps_legales
    ADD CONSTRAINT reps_legales_persona_natural_id_fkey FOREIGN KEY (persona_natural_id) REFERENCES personas_naturales(id);
 [   ALTER TABLE ONLY public.reps_legales DROP CONSTRAINT reps_legales_persona_natural_id_fkey;
       public       eureka    false    2127    202    222            �           2606    364867    tipos_caja_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY tipos_cajas
    ADD CONSTRAINT tipos_caja_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 T   ALTER TABLE ONLY public.tipos_cajas DROP CONSTRAINT tipos_caja_contratista_id_fkey;
       public       eureka    false    204    2096    179            �           2606    372319 &   variables_globales_contratista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY variables_globales
    ADD CONSTRAINT variables_globales_contratista_id_fkey FOREIGN KEY (contratista_id) REFERENCES contratistas(id);
 c   ALTER TABLE ONLY public.variables_globales DROP CONSTRAINT variables_globales_contratista_id_fkey;
       public       postgres    false    226    179    2096            �      x������ � �      �      x������ � �      �      x������ � �      	      x������ � �      	      x������ � �      4	      x������ � �      ,	      x������ � �      	      x������ � �      		      x������ � �      	      x������ � �      	      x������ � �      	      x������ � �      (	      x������ � �      	      x������ � �      0	      x������ � �      	      x������ � �      	   <   x��5 �x(��X��ihbdhiljjd��khl`jdod`hbb���Y�637����� �%      	      x������ � �      	      x������ � �      	      x������ � �      	      x������ � �      .	      x������ � �      &	      x������ � �      	      x������ � �      	      x������ � �      *	      x������ � �      $	      x������ � �       	     x�e�Ks�0��u�nI� �V$ �KE�v�a���E

����3ݝŻxA~!J�K�(���	X��|��tD"짩�z�����c�m��=�,3��[?�{��,��]�Uܯ��6��MfY���P��:�V��aQ䈨�0JLm`��?S�(~�Pf1d訯�V���Ɖr3���Y,�S-��G�B��\� ��r�{xc쨵[.�'�:�����:��*<���E��Q}�����e�v�?Jc��Ɠä��Ɛ��&��R���j����+��sci�      2	      x������ � �      "	      x��}Y��H������u����Y @�Ӻ/��@��o��.��.���ڽ���J�dG����K��ƒ�НҸv��ư�s�\ObNWa���P]��cϨe+͵e��v�bt5FxʊIKBG�k���p���%�72��UZz��$l����]��;��L�p8Rs��zƺ�QMN�'�G�Y>��G�)������k�bA�2���s�S�Ic�Q_?����{{uV��34�7$��\��'c]������(�8>�GxA>���s0��zy����9"U,dc�{�9C��]�=�N��8͓w��X�]���޹����s�^A�|tH|��CL�:N)����B=�[X�C`~��<����BLmc�0t�%�*������գ5��h{`�^�1�kx"�]5�3BF�ֺپ+�����Qߓ���aM�-��i����~�s����E��0*8��e�mhP�'c�amT'�Y��٭��?�{�9cx������`ԁ�Y����`y����D��D�3,�g�pTWM����5HXW��}{M��/�Y��m��N/N-tLa�����#�I_0�8��J!"��|��1�B�nV�?�`�Ll�<��<������ؾ=Ų�o�2��?��7�|`��b)��X�և�_���h?^�?pf��`]����=�˟`��P��4�j��8�����_׎x���w�Yb�;��8�;8�P5ǝ�� Jp����Pp����}��~�9���p�P ��;8<���;ω [��{\�7Ǚ�Է9�1�Հ�޹ƹ=ygMr�UG�l�#�2*��*MO����K)�kv�0
�N^�V�VY�]~��V����/>c���9�o���o��3x2���
$��ц��Ѽ�Ea�E����<+�|������/�ֿ�/+���O�˪�M�<������1t�1��y|yʗ�3_������ok��_��������XF�b9�7c���?���i�����2w��ˣg�O��}���ʷ���u2�@����� ����z����>�����&�M�\����=��;>���C������Ox�����!T�	Y�h��/�c�!z�*�?p5�s����$nv8.X����1��þ�����H��,����;��G`| T�����=�F_[��׼=7揹�W���|�xv��g~��]�][���(�vo��,����ߺgX;.xw�럫����|��<Pux�]���[���=�U�3�*7{yt�s��t(<��ܣ�dc�g�<�S���Xy��?����|�sg	���W�`�@��2n�~�)>����7�O������{-+k?�׏���x�}�����y��?݃~�6zt����w��+c�O�2~�`R2����9s�8O
b�b�O�>sC�p�c=�������_��1zv_�:�)`���cMQŀ�Q��`���Ϣ�JL��]�9G>[G����܃��䐇g>�X-@�K"|n>��];�3��`u���e�g����I�hhh����Η�B�m�8�sߺ���>���~3�~���������>����P�?�c������'�ɻ{+f���G�����5�|2<͓Il(�(�e�������q�d ����{_�_���=�L���+��+6���D����ϖ�&���GoY�)�4?����3 �~����;����ú��zN������i>��>�y0/����OXx��q4)l���W����m~��o��M�>�T�^�Uӛ�_�^�ޜ_���䉽Nc�PO�l��X�fi
 ���و�:q��=���y��_�VM~#U�}:���g�.�ĠP��i��`�� �����}i��g-�V.�KL�@̅��1]���랿W|]i^��b���gģ�S�[]����|�co��7�o�����O~M�\�ọ�~3�	�5�����
g{nwo�O����=�Cb`�*�{h2�-s���K1��ǯ�G�O�\N>񇗘 ���pg$Χ��;8���Q�]�oi���-X��C^�O./���O~+����5������u��  �կ��]w}�˿�,�s�%xߞ��_����������}�?��Ϟ�C��#L�{�W4ቦxɁ_��'ߊ=��O�.���eCoǋ���;��S��|����z��'^���'pY!�f�o����WP���ϵ�#+���w\����_x������g�S�g����������|�QΠv��.�s~�x��r�����=���|Gwx���!�t��<|�T������=����҄O����������[�į\���w_�\zt��3x�����Qb�+��;cг���gz5�ܾ[`���{~��;��z���g���r&߁3����g�����Թux���N&
\��<9��5�Q���Yg���������K�zU���M_����؏�{>�}M�rO1[�B�}�_�<��.o��Ť���}ry�O ��o�ً�� ��x\s(�9p��q�����/5�wj��x�l/�����/����隆09��K�[<ѾOm��Ѿ���W�{��
��~�u��)nQ��ig�{Ng	}�~�_J����������OjN��7��J޲?l��̀G�`���9���|6�����_�]�G9��D�k�����H�c��+���<������N^��G�'d��~�nm�~��ey�;<�!�G}ʱ>~��Y������Jׇgs����j|�����=_��a��������~-��yy�޻?��s�;��x6���O�;rF��η��&g{ծ��x����kǯ�þSo��π����_Ʊ~����K�|�?^�U�e.�y�2�R�͝ޫ��kd�?Q#{�_��
�z���G<i��x���{mq�>��Io�V���]�����W��~�v}��V�?�QO������UdF���zϓ��������^ƄWc��g|����i��:��1�����wn���2V���ln�L��s.y�9ӟ��x�;_�9O|����������}>|F�l��� 1��������r'��e��._m�x62??|��x�xN�9s�ٻ��q�Ɖ�]�_%/jݟ�l������m�����|%����U���6z�#�d������gc���;r�y����m��_^�[�m�i����H�k�#�[{��}������k��^X��{a��:��J��sοs�_FǼx����Y�G�DAM��=]�Ig"���{țe"�F.S�Ǵ:��Z�E�s.��o�����^��%���\����R��۹�;�,�U���ÿ�>����i/���V~%�^��/������Z��l�o���@����}�=7�$�z�0����{�w��}�_��|����a�������i��~C>�+5�wj���A�mC�*}�K�Z<�?�>����`��y�|䧽.����ߋaث�>�g+�������1𿙧�g�{��������^I�!�u��o�wR}���_�V����U���{�xע?�/�F�8z�3���_ږZ�q�����u��9��̓��:���W���?��:�w�j �h��p�s�❏YpŽã�~<�?)l��N����#m�ϴ��������׹�����'1�ׯMگ	t�
4Q��R?�G4��i��5��5������h���\8�f_�����/�C�?��>������?�oz�
�P�y�K���>w?�|�e���{׆u��h����؇)#X�k ���=���H�o�͞�?8�?Q{������/�G�w�p߯��C�0����Gg!Ư���5��5�ԛ �m{�?��3E�k/��'�Yqa����~��>��s�>�)���ԑ�S��:2�#!N|�\�6�x�/8��g�~����o�r��E}[_6��y���`�[k��a��f�5t'�³�>����<�,~ؿ�R���gH��c@��9�c�$@��ς�    ���:[���<�C����[��^7a��:�\�<��_�y�;u�_���T����~�D�=��~���~ʓ��o���D�Nt��� x���kd��^�gy�����Ō�y���<{�������J�*������r>��~�y���g 6]�:1�O�F?�g�!�?��yҿt�x�ҙE��ފ�yS�g����=�m�`�>��#���r|��xO��st��x���<#�i��yF]<{k~0�e��Y>Ր�Ī���o���x߷��C���Q������/���њ�x�+z��b�����3�{���=����I��������������'����e{�W���)�����͟���~f�g�w��{~�a���<�O�>m�P��<����O���a���p�)���_��V��{��_��=��_���@���� з(���S��D����g7�/~�7���D�b9���������ʟ�����9~X���;ߵ.�P�¿h�������=#��%����uW��?�g��p��W���G���������c����O���}���g�0|��z�����g�G�ٙ��$_�Z<�kg~���7oT�~��w�p/M �G5�oţ7m��\�{j�����^�u�9��s��o?���{A���
=?���������_x�2���~�3�K��=�>�)���:rtX��k~�y̟��!�� ��η������5᧶p�0��A��
~~�5�s�y���Y#���$�u ���~������f��Vl�g��1{��6 ��w����ϖCFQ��OP��{���S������0�]�}�G�>�-jҸ( �}���� x��7�����;�
|��i����ߛ��y����O��_�o��������w�����?��kQ������w}Ǻ<�\|�វE����?�o�}ʷp�˞��Q���z��R��d��G���Wr�󪟯������G���M��V��^�������a����_�����O~��i^Yq~�I����gR==3����h�������h�F���8��sߵ.w��=����˶rh#�O�K�=,�3��瓂��p��Oy;`'�G��K?����K�{����~�WΙ��������}Ж�l����q��}���q�i���]='���?����G���{^�Gv �Ƴ�a��{y~��S�
�z������y�\��M��?����*`N_z-����ad�s?0'Bƞs��������O��c��Bz��T��8;&�?��P���0GI��t-��S��B��J����R\�鎱nhÔ5'����3Xw�[zdN{Q<74�2��,8$�R�`ANE�F8�/{Kt+5z�w�g"�se)mbr���uz،+h$T��^!��M[�5���Qvlqblr�tөH(�E�EjG�v9��`K���$�^�Y����i��86X�@�=9uJ�R��4u1�Iq�+��s�Á�qp��<�۴_�~�����8��< �V{L����۵,SE�I'��i/�6s�N�)e�[gg��+{)�ݬ��Ev�Ȋ*�Z����y��Y/�*�5�-�s��kvG�nT��i�U~L��ɻ�*\��U�h�a�k���RQ̩l��ҥ�z�&oo�8����&�+KC��3e�8�܆Ҕ�w+}m����ӥ_����I�թ�R���틜OZ'n��5�8�S��.B*I�ٔ�������2�b�Hd%��t��4i�6��9^���h�@�Kr6a2�̳?U:�K��G��>(
u%l�^�Wڮ���b��Թ4��v�z��+���pomY�{����-d/<9�c��W�+o��X���ȵ>�7��l:�L�nw�2�(���1Ã}�V�وdz��6�R���hq��w�N<Z%J�&��Q�P��ʣ��W�ĩ2v�P���4�,��ȳl�Z0�[xuM��b
ºt�Q��ȑ�]t����R(����!.���>�j	 ��,'�dfu3nscz�pB��8�;�ky�u�m�t��"6=��9��r����D��J;��^�Ү�D��f�L�';m����it�5ye��h1{#�;!�������us�p�,VnÖ�Գ�P��\�>U��)Ճ� %<��Z���KC:��ډ�p��|.�"Ɛ��]JS�;�BY&�PEu���s�T��$(��(Ew�3%��I�F	��������<'9���8�f�o/�m�ËXZJ8`�dS��H�����0?�芳�Yv⩓���E���ʷL)�/�V`!i�*��(�H�̀�]>_�]Rכ�J]2�n���1�y;���~�B`��!��C�C��6[l��-��W��H���#�#]k���y�:l=��pȄY��k[�f���ݙ�6D ���ܲ��� G�����`1t8@�yY��_��n��hU��e��"jF�@�����Y��k���r��S0&��u�D�3ZA9�2��F��7q��܆m4y}j"(����W!�L
��0m�.��5���;[���r؝�G^� �m�vA�-��:�N�I��1Ŗn
���۸&�)6�t��G�jhV�����¯��-UJQo��֡�m��l�����kT�i�1ဪq��7���A��9���U&Ep�w<��|��.Vn��d���5'lѷ�y�%��]��Nݺ^�'���@@�"Y�b�L��3�Yw�8��3A�#%XA��߉��
dƟ���	��᫖���͡e�4�	�l��(��tfOк�8�i-�e���j".���K�8J�rQ/pڔ��^�Y�g�ť��5��y�7W�j����s�r�Eg"����a����fw3]r�TDx�=�r��$b3��z27�Ur�A�NÆ���L;��kbY%ة��,`�r��8XDIE��|X���Q����Yq��s�V-�ӹ6�DMK���IgW�R�'�p�-�r��ٮTi����\*��+h��&��;�z+���;*"�^�c�'Dl�z��J��+ր���0n�w�ɒ�hvLj(�K�0m6�LA��W�cbo*7� tC��:;G��� 6H��o�p���E,��~�eH�
�K������ݸl���v��ln��:�#��%�����GC��b�;�E�֣Uq낟��ŚJH-�V�S����4�2ڭ�)��7�@�qK�Мt�&�z/ ��IcY�<��RT´=�gܤ&����زlVL4\�+���q���H+l�W;��Qڑ�t@<]�}H��ל�Z�MF�tn8m�4V���
������t�}a��	�U�k��o+�\Yd�(�Z����s޲�&�a�
p���zq*�+p���Dz�qk�d����H純�2ۢ��ڙQ�=�a��Ws��	bMZEƮ@�m���/s�C�j��/Į�0#���4,�1��6n���i�E"T�!k�"�3d[퉼&+��.�ú/^̈�9"����(Eȼ�;�_�L�7���Cg�x����TK!��'�B·'��Un����Z�ne�h�]���'�V	�/�__(�֛�&X�6�F��#�"^S
b/��2+���W��D;�.�.�z HL����&RָQ���^�E���g4��y���j��C�l�qN�m�����^EĒ���Ԗ�(�Mm�'��#MQȹ9��Յ�9�Ǻ��e�d�>��� �i�nj����v�bת�6����D�:"�iG�"a̾��a<�6�I��}�Z��f>��l��b
N<��_��&�hn��ԁF��2J��f9��1_�4��t�h�BC���Cy����D��qw����G(��p�a��i��z��OW^;��~
o<�4%����VI�X�2�S�J�6M[ȫz��,�RԴގ����)&ϑ�ǜ���l��c,}K�-�]}���)�.�p�STt݊�)���'��#�Ɖ�p�aWoj�͙/�/AP5W�8İM���_=c��y�F�V��2�U3��=���?�0g+�I#@'�͠�';����k��Ƴ]�j"��!�+�&�&���b@Q���$��Ȋ�.�w��1�1��Gv��8�K��r    ��J�R���)#���7���)�z��`��9�;�%L"�d�8�u>͍7H��Ѭ�c]�����mڗ�J�g>aX/DB��y2��u�� ��/>�h���t���P���9� �T~��Hm�vI̕S���Zrk�n�hl{�5j�'�y?K�<I#�1��9�J��B`�BDǽOml��5y�H�x��q51�]�5��d] W�9Ԙ����(���t�X~`G2J鵳	�� ��׼>m��t�)�$YtU7�z >
]+�:$�� �:�qI�*�Cȭȉ�|�@�ޓ�� fuE����F=�GS15n��UՆ詸!�k~J�;�i-d���lo�]�-f�phᓸ��#@�5�9n�J��Dmwƶ�L��ߡ�뢞l�6��˜���C;�E+��>�"VL
���3�1�J��R١����"��vg�Ԏ�� 1�h��5,���F)#�,_�h�
⻏P��� �Q.<tS�
�,,VW�rB�ܛ��H|<�lQ#���Kןkq��L����&��F�5&J�q���>pB[�]����b��1���h���;���-���]��y����^��Cr���I�<�(�onk�G��1ӚAЖk�o�+R����&_�����ğ��-AF�*F��-k^��D@�\գrŢۉ6;��s.�ns�b{a8�CG��ţ[&�M�)E����F���Gn#�G��t�W7����:�2mi�py��Y�}���.�Prخ�tLb+��yXH����`�4H%��R�]˝���p[7[Ѩp=�a��#�t^�wd<�:�rS=��[x��(�C��D���.wt�X����U\k{����%��A��#�%�*��Ρ��x[ㆯS&91���� Z��=BR��[���� �i��Nvj1�it �Q�����'�{j#lҕ�A�)Qhw�4�z����4j���+������}�׺�����s�aɀ�
g<����ac�vġ���X�GT]7��R�2�X�oٻ��H���QOy{����a腸Q�]o�"���\OM
-^W�o"BA�ZmgY���2�t$���`A�^�����a��A�s�]���ѻ��m��.�ks�M��5[��=UI��â�Y��,lG~��
Y����O'�KfUn[V�u��䠶��C'F���?�2	���C�"@U�N�@z[���Mu�����N�֣| Qen�:݆�r����Y�.��T�қ �T	�/����x�]�Lk���2e�$�]GI�^8�+[�;*{�!X���$5�-�q�v��,ET�;b9%�`����3~f̸4����YT��6�N}��EK0]�K�V�t1KƋ��R[�, �~�=\GD8&ni^c.+�� 8��K�OG������p�;��	��L`PGbį��`%�f�۸uXX8o ��ވ�(���{W�\X9��`��؉�ޅdh5�ыw�9�%0,��"iĵ���-���;GdS��� D[�ױU��j�ws��X *���@��9Lq>#s�$�K
���0Ff�Sm :Mm���*$~�7>����jy��X�;�v^=���C}�0�+i���_X����ԭ�h�%�v�rvo9vDݵ#�1�3U�0K��U�T��ٴ`�HP�3�����*Gjay]`t�������Dnd,��q]�D�Oٴ��	��aW�acag����	9EP��%!2th��r,\�2��An�q��9.��m�[�j
��˕�������P���A�����g}��

���sv!�V(�ؓ"�'q{k�&��0~���>��D8�������׶~�S��x�����i��XNfmw�U���Cum���v2�T�+n;ɚ��H�k��%WK�C{EUe��G�Vx� �!��~!�A�K��!b�\9w�X��m�.���G������O��I��A��ڣ�2ó�̆.P�Ե�J�,^"xP�0����:4Y���p	w��ɗ^�d�xR94�2���F�箧���O۫��I2�Qt�M|)���t)�u�˔y� �B��w���f�%ˣ{�Fϕ��aR'��i�,�:�ܵ5��Ó�${�\j�/�L?�����?��A�az����F`�j�E�%8x�N�.8�,";�m�#,)<б�gM0�+��� ;��{% 4Y��ɷ�71���u�U��m���'N�TW����=���7��J��%U�2d��U���Îh���v��5��EF��m�7��f:�@�~W�a��f��Հw�wE�H̸��[ ̀V�J>�P��$�&H�$}ј8&0C��xu�;�*^vt'�)g8b�^�kXr���\��|ϣ����W�4�*t���k�ci����r�gN�5����-!qz��Tu��-��K�m�����P_�E�w�{�G,t�����S��;��z�IE�	]f�g��֗���Q��!;Qk�w�٠X��Zl��mgB�á�ڞJ1����S���>�B�q��s'Ӳ�xT2$��=)�Ǚ9æ�'{n}"HKx��u��I�F��FAщB��6Ƭ�Xz��싙��[l~�tS[@;y3�m.�<�K�lU'�l�^!U�Tܰ4Ҷ4�H<`�y ��ͤ���zY93�8{k���NO]_c�\�09��� էT�DY�)&E#�K�`�y�|�D\��a�v�b�-ڰ~�_<]p����ٯ�]9u�5V��[�I�L�@��#�xi|48	�i�C�Iy(�H�7
V�
c���rh	��_���{����[囃�,sp�h�mxo܆�x�����d��d�v��g���s���� �tb������(��n�[D�������̂9[X���w�蘘�0*K��\q]�nYM�Υ��z������򡣉�B��U9e�Mb^� a���4�Qpӻ�6F��=9�@�5�\%5]��-Uh�S��s�G<�^�a�*�� ���qf��~��P�68�2h¤�v�ix<l��'�+�K�_Dd��,
�����7�Y%E�$~��:��0i�U(n`^�s\��[u�LC�Kg�ɯPX�P�<�!�a5jԂ&�V�mVS��NK�C��Ц>MD��9�O9�m��F������,3�F��)��!w8��t_(C��禌�B�9�2��v7UI�t�uo�p�9��|�S���(冤7��v�^�l��]�캀���6ݍs��kpuL��l|vz&:�C܀P���'z�Wچ���:;L$�WF.:��@�x��6��O[�2�+����TO��-�s��ʹjr<�G����^⥖*XE���L�%�V&s�Ŵ7p	�$V����rn�*��q�3 �����A���������hkZ�	��R!w��v^��J�v�A������n5��Ej¿^�O�l��X(�f� J��W�SD�Mdk}�Lz�Xhnf�/��Z,�α<�p�g{*��J`D#k4�Scq�]�!������!��(��w��Za���2������su�ɇV���t����-��jf�aٹ���6��t|��B�����t;�
�'u�_	,�UN�(9{f���
E�7jݏ���NO��=*�.N��r@�|�h����88{��YlG��`#�v����ֈ���R�Wn�z�#촹vQ>��nb*�",g����d�擤�#�|��+G�&��:4��m�g��E�M��+�-��S�����?�+�h��/E��L��
��ZuT�5ń��;�谒Κ��Vc�� �ˍ\�n�Oh6���K���{v���6;��VtD�5s���lug�G��]. �7�#�����`.��\Q�o��(u9»z�#-n{e�"���5	�����5�lT�+��fQ�5ķ�}Q�]y�n�0��PnÙ��܃&7����=ܜ�P��d�b ���	6nW��^��p�=��3�j��BӉ���4�؄��\ĸ��\�u�af�1�"�<��6�(������ԧv�̅�z��(l$�\6E���`����l���X�5qQ��88t�]���ċ*Ɩ��vUD��[O�"���1����F�nu|�{�	��� �  ?�Y�+=-�r�!�aa��Q�ˌ�7��4�D��:1�������1Xݚ�3�bv���^L� ���X����6Z�F���`1{x��W"���}��z���ъT$�3T6Q�=$L�t�n6iĒ[U�B���̙FtI�,������UIie_+�$t�)ɲ�M�TQ���aA�T�:�"�q7�?HJ�g�y��F��u��d�H�3��o��T_W�E���m6�ޚ4 �p��*&A�[!8���If�����j��Tj�p�ˮڢ�I�]T^�n�!��KXr+k�}�C�.�|B�,IB >�7��Ô�ÁUև��M�g۹�^���a��+��̯c�l1�޻tK��m�l��8"p�o��d���\nPN�R��|�Y��U�~�����+�9��sb$��a�oՁ;Hڕ<zK�7ɩ����9�'����N��`�-U�G�K�%SÍF�l��$^�!�nCArE�����j���;�T��]���Ĝ��qZ�DAn̢C��h�!6�s�Hrh�^���f�����h��-��Tx赍�C}h�UK����c�<���3�0�$6B^�2@�z�ߚľ�)���첪E�@Sn��@���v��	�ir�\�}ו�=Cv�7�DԓIx@�Q�E2:b}Sq�ZQlhN��8�:^.q�����۰X�ȔJ��~Sc�^.\��yo��31�ή�q�($���&�K
��IH���w��5�4�pFh͎�|eDW��AX}d8���EM�gOK�4m� ���'�w7h���Ι#�aﯳ5�^Qi�9f�b�R��ЦS%�N�O��oS�ҙ�>����pl6�gM��*Mp�Wx3v�־$ZX�Q%�9�_-d �x��X����D+Ė7�[D���WY���-��f<@���'�e9�L��^N+M����3�b�S�[3؊	�1��ʼ;/c��	����5~h�&«��ҹ׼�<����Q��iVhE�w����(F��DV�i	�~PNͥ��f���F�]�ć2(��G�q,��bO�V��s��� +%������(0�Э[��1�>@�(�w<y.m��1�m�,|�\����1�0LF�O1i3)КA���S]wU�gb�yVC|:;L$;��L�79ԗ�T�-P˖���`�t�㮖��v��29eֲ]&�z6��U�k�WO+�=�JF-9�9�.sJ06���܎���|9��To��A7|T�z�ثY��\ۋo�'d�V
���X�����Mi����>�u��_X�c]B����Xn���۫,Q�����hB����2 ]>��:X���$�^�b���d�=][(kс��Z�X�d̖q$L5(ύ,��;@kR�7�bn�`�B�����������([׷A��xJ"d�O� �n����oP�|������j���9l[FIh�eKcۊ�[�U!���=�j����v`�8��m�֐���bXr�j����B��S�X�D���?�^�c�3'����D��K.T�B���s�P�Z�]e�6hgWۗ�р6Ĉ� J�{����;����9>��r�3�%ޝ����
d)I3�^�|p��T�LkG���ǃ����چc�B5$�o��S(�H'��"|I�-P�W��.���9윃eQDc��%o�S�;춹���zl���J��q�g@�g���4P-�C�zBZI9.F�fv���R���斥T~5�!�&��"oݘ+g1i�Wl�g�ʅ4�n�f�����h�|lF��l[�S��7��Ӿ�(�wL�%&��Іu�������HஹY<w��^&����Ս�����J6�TK��R�l��$�Q!S7�
������=�a��j}������h��Bf湞�T7ɐ�}>܍�nwC�갻ܴ��vXO�M����{����U�jI�E��<�2[�6�r�f�!�ͪɃ�\�᪡~�α�?t<K��s�RJ���>�L�������������-���     