--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Name: f_after_del_ccom(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_del_ccom() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
    if ( SELECT count(*) from ccommandes where id_co=OLD.id_co and etat=0)=0 then
      update commandes set etat_co=2 where id_co=OLD.id_co;
    --elsif ( SELECT count(*) from ccommandes where id_co=OLD.id_co and etat=0)=0 then
     -- update commandes set etat_co=0 where id_co=OLD.id_co;
   end if;
   --end if;
  
return NEW;
end;$$;


ALTER FUNCTION public.f_after_del_ccom() OWNER TO imidsac;

--
-- Name: f_after_del_cfac(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_del_cfac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
    if ( SELECT count(*) from facture_con where id_fac=OLD.id_fac and etat=0)=0 then
      update facture set etat_fac=2 where id_fac=OLD.id_fac;
    else
      update facture set etat_fac=1 where id_fac=OLD.id_fac;
   end if;
  
return NEW;
end;$$;


ALTER FUNCTION public.f_after_del_cfac() OWNER TO imidsac;

--
-- Name: f_after_delete_employe(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_delete_employe() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
delete from epaiement where id_em=OLD.id_em;
return OLD;
end;$$;


ALTER FUNCTION public.f_after_delete_employe() OWNER TO imidsac;

--
-- Name: f_after_delete_epaiement(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_delete_epaiement() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
delete from tepaiement where id_ep=OLD.id_ep and id_em=OLD.id_em;
return OLD;
end;$$;


ALTER FUNCTION public.f_after_delete_epaiement() OWNER TO imidsac;

--
-- Name: f_after_inser_employe(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_inser_employe() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
m integer;
begin
m=extract(month from now()::date);
      for i in m..12 loop
         insert into epaiement(annee,mois,id_em,emontant) values(extract(year from now()::date),i,New.id_em,NEW.montant);
      end loop;
if m>1 then
for i in 1..m-1 loop
         insert into epaiement(annee,mois,id_em,emontant) values(extract(year from now()::date),i,New.id_em,0);
      end loop;

end if;
return New;
end ;$$;


ALTER FUNCTION public.f_after_inser_employe() OWNER TO imidsac;

--
-- Name: f_after_insert_achat(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_achat() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
moi integer;
an integer;
prix integer;
r record;
begin
update articles set stoc_ar = stoc_ar + NEW.qt_ar where id_ar=NEW.id_ar;
select into r prix_achat from articles where id_ar= NEW.id_ar;
prix=r.prix_achat*NEW.qt_ar;
select into r extract(year from NEW.a_date) as annee;
an=r.annee;

select into r extract(month from NEW.a_date) as m;
moi=r.m;
update benefices set achat=achat+prix, benefice=vente-(achat+prix) where id_ar=NEW.id_ar and annee=an and mois=moi;
update benefices_total set achat=achat+prix,benefice=vente-achat-prix-depence where annee=an and mois=moi;
return NEW;
end;$$;


ALTER FUNCTION public.f_after_insert_achat() OWNER TO imidsac;

--
-- Name: f_after_insert_ccom(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_ccom() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
   
    if ( SELECT count(*) from ccommandes where id_co=NEW.id_co and etat=0)=0 then
      update commandes set etat_co=0 where id_co=NEW.id_co;
    else
      update commandes set etat_co=1 where id_co=NEW.id_co;
end if;
return NEW;
end;$$;


ALTER FUNCTION public.f_after_insert_ccom() OWNER TO imidsac;

--
-- Name: f_after_insert_cfac(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_cfac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
      if ( SELECT count(*) from facture_con where id_fac=NEW.id_fac and etat=0)=0 then
      update facture set etat_fac=2 where id_fac=NEW.id_fac;
    else
      update facture set etat_fac=1 where id_fac=NEW.id_fac;
   end if;
  
return NEW;
end;$$;


ALTER FUNCTION public.f_after_insert_cfac() OWNER TO imidsac;

--
-- Name: f_after_insert_depence(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_depence() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
moi integer;
an integer;
r record;
begin
select into r extract(year from NEW.date_dep) as annee;
an=r.annee;
select into r extract(month from NEW.date_dep) as m;
moi=r.m;
update benefices_total set depence=depence+NEW.montant,benefice=vente-achat-NEW.montant-depence where annee=an and mois=moi;
return NEW;
end;$$;


ALTER FUNCTION public.f_after_insert_depence() OWNER TO imidsac;

--
-- Name: f_after_insert_update_dele_achat_con(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_update_dele_achat_con() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
if TG_OP='INSERT' then
        update achat set somme=somme+NEW.montant, reste=somme+NEW.montant-payee where id_ac=NEW.id_ac;
        if  (SELECT count(*) from achat_con where id_ac=NEW.id_ac and (etat='p' or etat='t'))=0 then
		update achat set etat_ac='n' where id_ac=new.id_ac;
	elseif ( SELECT count(*) from achat_con where id_ac=NEW.id_ac and (etat='p' or etat='n'))=0 then
		update achat set etat_ac='t' where id_ac=new.id_ac;
	else
		update achat set etat_ac='p' where id_ac=new.id_ac;
	end if;
return NEW;
elsif TG_OP='UPDATE' then 
        update achat set somme=somme+NEW.montant-OLD.montant,reste=somme+NEW.montant-OLD.montant-payee where id_ac=NEW.id_ac;
        if  (SELECT count(*) from achat_con where id_ac=NEW.id_ac and (etat='p' or etat='t'))=0 then
		update achat set etat_ac='n' where id_ac=new.id_ac;
	elseif ( SELECT count(*) from achat_con where id_ac=NEW.id_ac and (etat='p' or etat='n'))=0 then
		update achat set etat_ac='t' where id_ac=new.id_ac;
	else
		update achat set etat_ac='p' where id_ac=new.id_ac;
	end if;

        if old.etat='n' and (new.etat='p' or new.etat='t') then
		update articles set stoc_ar=stoc_ar+new.qte_livres where id_ar=NEW.id_ar;
        end if;
	if (old.etat='p' or old.etat='t') and new.etat='n' then
		update articles set stoc_ar=stoc_ar-old.qte_livres where id_ar=NEW.id_ar;
	end if; 
   
	if ((old.etat='p' or old.etat='t') and (new.etat='p' or new.etat='t')) then
		update articles set stoc_ar=stoc_ar+(new.qte_livres-old.qte_livres) where id_ar=NEW.id_ar;
	end if; 


--if NEW.etat=1 then
--update articles set stoc_ar=stoc_ar+NEW.qt_ar where id_ar=NEW.id_ar;
--if ( SELECT count(*) from achat_con where id_ac=NEW.id_ac and etat=0)=0 then
--      update achat set etat_ac=2 where id_ac=Old.id_ac;
--    else
--      update achat set etat_ac=1 where id_ac=Old.id_ac;
--end if;
--end if;
  return NEW;
else
       update achat set somme=somme-OLD.montant,reste=somme-OLD.montant-payee where id_ac=OLD.id_ac;
       if old.etat='p' or old.etat='t' then
		update articles set stoc_ar=stoc_ar-old.qte_livres where id_ar=old.id_ar;
	end if;

	if  (SELECT count(*) from achat_con where id_ac=old.id_ac and (etat='p' or etat='t'))=0 then
		update achat set etat_ac='n' where id_ac=old.id_ac;
	elseif ( SELECT count(*) from achat_con where id_ac=old.id_ac and (etat='p' or etat='n'))=0 then
		update achat set etat_ac='t' where id_ac=old.id_ac;
	else
		update achat set etat_ac='p' where id_ac=old.id_ac;
	end if;   
return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_insert_update_dele_achat_con() OWNER TO imidsac;

--
-- Name: f_after_insert_update_dele_cco(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_update_dele_cco() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
if TG_OP='INSERT' then
  
  update commandes set somme=somme+NEW.montant, reste=somme+NEW.montant-payee where id_co=NEW.id_co;
  return NEW;
elsif TG_OP='UPDATE' then
   
   update commandes set somme=somme+NEW.montant-OLD.montant,reste=somme+NEW.montant-OLD.montant-payee where id_co=NEW.id_co;
if NEW.etat=1 then
update articles set stoc_ar=stoc_ar-NEW.qt_ar where id_ar=NEW.id_ar;
if ( SELECT count(*) from ccommandes where id_co=NEW.id_co and etat=0)=0 then
      update commandes set etat_co=2 where id_co=Old.id_co;
    else
      update commandes set etat_co=1 where id_co=Old.id_co;
end if;
end if;
  return NEW;
else
  
  update commandes set somme=somme-OLD.montant,reste=somme-OLD.montant-payee where id_co=OLD.id_co;
  return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_insert_update_dele_cco() OWNER TO imidsac;

--
-- Name: f_after_insert_update_dele_cfac(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_update_dele_cfac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
if TG_OP='INSERT' then
	update facture set somme=somme+NEW.montant, reste=somme+NEW.montant-payee where id_fac=NEW.id_fac;
	if  (SELECT count(*) from facture_con where id_fac=NEW.id_fac and (etat='p' or etat='t'))=0 then
		update facture set etat_fac='n' where id_fac=new.id_fac;
	elseif ( SELECT count(*) from facture_con where id_fac=NEW.id_fac and (etat='p' or etat='n'))=0 then
		update facture set etat_fac='t' where id_fac=new.id_fac;
	else
		update facture set etat_fac='p' where id_fac=new.id_fac;
	end if;
return NEW;
elsif TG_OP='UPDATE' then
	update facture set somme=somme+NEW.montant-OLD.montant,reste=somme+NEW.montant-OLD.montant-payee where id_fac=NEW.id_fac;
	if  (SELECT count(*) from facture_con where id_fac=NEW.id_fac and (etat='p' or etat='t'))=0 then
		update facture set etat_fac='n' where id_fac=new.id_fac;         
	elsif ( SELECT count(*) from facture_con where id_fac=NEW.id_fac and (etat='p' or etat='n'))=0 then
		update facture set etat_fac='t' where id_fac=new.id_fac;         
	else
		update facture set etat_fac='p' where id_fac=Old.id_fac;
	end if; 

	if old.etat='n' and (new.etat='p' or new.etat='t') then
		update articles set stoc_ar=stoc_ar-new.qte_livres where id_ar=NEW.id_ar;
        end if;
	if (old.etat='p' or old.etat='t') and new.etat='n' then
		update articles set stoc_ar=stoc_ar+old.qte_livres where id_ar=NEW.id_ar;
	end if; 
   
	if ((old.etat='p' or old.etat='t') and (new.etat='p' or new.etat='t')) then
		update articles set stoc_ar=stoc_ar-(new.qte_livres-old.qte_livres) where id_ar=NEW.id_ar;
	end if; 
return NEW;
else
	update facture set somme=somme-OLD.montant,reste=somme-OLD.montant-payee where id_fac=OLD.id_fac;
	if old.etat='p' or old.etat='t' then
		update articles set stoc_ar=stoc_ar+old.qte_livres where id_ar=old.id_ar;
	end if;

	if  (SELECT count(*) from facture_con where id_fac=old.id_fac and (etat='p' or etat='t'))=0 then
		update facture set etat_fac='n' where id_fac=old.id_fac;
	elsif ( SELECT count(*) from facture_con where id_fac=old.id_fac and (etat='p' or etat='n'))=0 then
		update facture set etat_fac='t' where id_fac=old.id_fac;
	else
		update facture set etat_fac='p' where id_fac=Old.id_fac;
	end if;           
return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_insert_update_dele_cfac() OWNER TO imidsac;

--
-- Name: f_after_insert_update_dele_depence(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_update_dele_depence() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
if TG_OP='INSERT' then
SELECT into r codesbase();
update benefices_total set depence=depence+NEW.montant, benefice=vente-achat-depence-NEW.montant where extract(month from NEW.date_dep::date)=mois and extract(year from now()::date)=annee;
return NEW;
elsif TG_OP='UPDATE' then
update benefices_total set depence=depence+NEW.montant-OLD.montant, benefice=vente-achat-(depence+NEW.montant-OLD.montant) where extract(month from NEW.date_dep::date)=mois and extract(year from now()::date)=annee;
return NEW;
else
update benefices_total set depence=depence-OLD.montant, benefice=benefice+OLD.montant where extract(month from OLD.date_dep::date)=mois and extract(year from now()::date)=annee;
--delete from fpaiement where id_fo=OLD.id_fo and id_ac=OLD.id_ac;
return OLD;

end if;
end;$$;


ALTER FUNCTION public.f_after_insert_update_dele_depence() OWNER TO imidsac;

--
-- Name: f_after_insert_update_dele_ventes_con(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_update_dele_ventes_con() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
if TG_OP='INSERT' then
  
  update ventes set somme=somme+NEW.montant, reste=somme+NEW.montant-payee where id_ve=NEW.id_ve;
  return NEW;
elsif TG_OP='UPDATE' then
   
   update ventes set somme=somme+NEW.montant-OLD.montant,reste=somme+NEW.montant-OLD.montant-payee where id_ve=NEW.id_ve;
if NEW.etat=1 then
update articles set stoc_ar=stoc_ar-NEW.qte_ar where id_ar=NEW.id_ar;
if ( SELECT count(*) from ventes_con where id_ve=NEW.id_ve and etat=0)=0 then
      update ventes set etat_ve=2 where id_ve=Old.id_ve;
    else
      update ventes set etat_ve=1 where id_ve=Old.id_ve;
end if;
end if;
  return NEW;
else
  
  update ventes set somme=somme-OLD.montant,reste=somme-OLD.montant-payee where id_ve=OLD.id_ve;
  return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_insert_update_dele_ventes_con() OWNER TO imidsac;

--
-- Name: f_after_insert_update_delete_boutiques(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_update_delete_boutiques() RETURNS trigger
    LANGUAGE plpgsql
    AS $_$declare
r record;
q record;
begin
    if TG_OP='INSERT' then 
        for r in select * from articles 
        loop
	    insert into produits(id_bo,id_ar,pvente,etat) values(NEW.id_bo,r.id_ar,r.prix_vente,r.etat);
        end loop;
        for i in 1..12 loop
            insert into gdepenses(annee,mois,id_bo) values(f_annee(),i,NEW.id_bo);
            insert into benefices_total(annee,mois,depence,achat,vente,benefice,id_bo) values(f_annee(),i,0,0,0,0,NEW.id_bo);
           -- for q in select id_pr produits where id_bo=NEW.id_bo loop
           --    insert into astatistic(annee,mois,id_bo,id_ar) values(f_annee($1),i,NEW.id_bo,q.id_pr);
           -- end loop;
        end loop;
        insert into caisses(annee,id_bo) values(f_annee(),NEW.id_bo);
       return NEW;
    elsif TG_OP='UPDATE' then

       return NEW;
    else
       delete from produits where id_bo=OLD.id_bo; 
       delete from gdepenses where id_bo=OLD.id_bo;
       delete from benefices_total where id_bo=OLD.id_bo; 
       --delete from astatistic where id_bo=OLD.id_bo;
       delete from caisses where id_bo=OLD.id_bo; 
       return OLD;
    end if;
end;$_$;


ALTER FUNCTION public.f_after_insert_update_delete_boutiques() OWNER TO imidsac;

--
-- Name: f_after_insert_update_delete_garticles(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_update_delete_garticles() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
    if TG_OP='INSERT' then
        for r in select id_bo from boutiques
        loop
	    insert into produits(id_ar,id_bo,pvente) values(NEW.id_ar,r.id_bo,NEW.prix_vente);
        end loop;
       return NEW;
    elsif TG_OP='UPDATE' then
	if NEW.eta<>OLD.etat then
            update produits set etat=NEW.etat where id_ar=NEW.id_ar;
        end if;
       return NEW;
    else
       delete from produits where id_gar=OLD.id_gar;   
       return OLD;
    end if;
end;$$;


ALTER FUNCTION public.f_after_insert_update_delete_garticles() OWNER TO imidsac;

--
-- Name: f_after_insert_vente(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_vente() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
moi integer;
an integer;
prix integer;
r record;
begin
update articles set stoc_ar = stoc_ar - NEW.qt_ar where id_ar=NEW.id_ar;
select into r prix_vente from articles where id_ar= NEW.id_ar;
prix=r.prix_vente*NEW.qt_ar;
select into r extract(year from NEW.date_ve) as annee;
an=r.annee;

select into r extract(month from NEW.date_ve) as m;
moi=r.m;
update benefices set vente=vente+prix, benefice=vente+prix-achat where id_ar=NEW.id_ar and annee=an and mois=moi;
update benefices_total set vente=vente+prix,benefice=vente+prix-achat-depence where annee=an and mois=moi;

return NEW;
end;$$;


ALTER FUNCTION public.f_after_insert_vente() OWNER TO imidsac;

--
-- Name: f_after_insert_verait(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_insert_verait() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
--r record;
--c record;
begin
--select into r somme, type from verait where id_b=NEW.id_b;
--select into c solde from bamk where id_b=NEW.id_b;
if NEW.type='v' then
UPDATE bamk set solde=solde+NEW.somme where id_b=NEW.id_b;

else
UPDATE bamk set solde=solde-NEW.somme where id_b=NEW.id_b;

end if;
return NEW;
end;$$;


ALTER FUNCTION public.f_after_insert_verait() OWNER TO imidsac;

--
-- Name: f_after_update_ccom(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_ccom() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
c record;
an integer;
mo integer;
prix integer;
begin
   select into r prix_vente from articles where id_ar=NEW.id_ar;
   prix=NEW.qt_ar*r.prix_vente;
   if New.etat=1 then
   update articles set stoc_ar=stoc_ar-New.qt_ar where id_ar=Old.id_ar;
    if ( SELECT count(*) from ccommandes where id_co=NEW.id_co and etat=0)=0 then
      update commandes set etat_co=2 where id_co=Old.id_co;
    else
      update commandes set etat_co=1 where id_co=Old.id_co;
     end if;
   end if;
   select into c date2 from commandes where id_co=NEW.id_co;
   select into r extract(year from c.date2) as annee;
   an=r.annee;
   select into r extract(month from c.date2) as mois;
   mo=r.mois;
   if NEW.etat<>OLD.etat and NEW.etat=1 then
   update benefices set vente=vente+prix,benefice=benefice+prix where annee=an and mois=mo and id_ar=NEW.id_ar;
   update benefices_total set vente=vente+prix,benefice=benefice+prix where annee=an and mois=mo;
   end if;
return NEW;
end;$$;


ALTER FUNCTION public.f_after_update_ccom() OWNER TO imidsac;

--
-- Name: f_after_update_cfac(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_cfac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
  if new.qte_livres<>old.qte_livres and new.qte_livres<new.qte_ar then
      update facture_con set etat='p' where id_ar=new.id_ar and id_fac=new.id_fac;
  elsif new.qte_livres=new.qte_ar then
      update facture_con set etat='t' where id_ar=new.id_ar and id_fac=new.id_fac;
  end if;

return new;
end;$$;


ALTER FUNCTION public.f_after_update_cfac() OWNER TO imidsac;

--
-- Name: f_after_update_delete_achat(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_delete_achat() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
if TG_OP='UPDATE' then
update benefices_total set 
achat=achat+NEW.payee-OLD.payee, 
benefice=vente-(achat+NEW.payee-OLD.payee)-depence 
where extract(month from NEW.date_1::date)=mois 
and extract(year from  NEW.date_1::date)=annee;
return NEW;
else
update benefices_total set 
achat=achat-OLD.payee, 
benefice=benefice+OLD.payee 
where extract(month from OLD.date_1::date)=mois 
and extract(year from OLD.date_1::date)=annee;
delete from fpaiement where id_fo=OLD.id_fo and id_ac=OLD.id_ac;
return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_update_delete_achat() OWNER TO imidsac;

--
-- Name: f_after_update_delete_commande(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_delete_commande() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
if TG_OP='UPDATE' then
update benefices_total set vente=vente+NEW.payee-OLD.payee, benefice=vente+NEW.payee-OLD.payee-achat-depence where extract(month from now()::date)=mois and extract(year from now()::date)=annee;
return NEW;
else
update benefices_total set vente=vente-OLD.payee, benefice=benefice-OLD.payee where extract(month from now()::date)=mois and extract(year from now()::date)=annee;
delete from cpaiement where id_cl=OLD.id_cl and id_co=OLD.id_co;
return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_update_delete_commande() OWNER TO imidsac;

--
-- Name: f_after_update_delete_facture(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_delete_facture() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
if TG_OP='UPDATE' then
update benefices_total set 
vente=vente+NEW.payee-OLD.payee, 
benefice=vente+NEW.payee-OLD.payee-achat-depence 
where extract(month from OLD.date_fac)=mois 
and extract(year from OLD.date_fac)=annee;
return NEW;
else
update benefices_total set 
vente=vente-OLD.payee, 
benefice=benefice-OLD.payee 
where extract(month from OLD.date_fac)=mois 
and extract(year from OLD.date_fac)=annee;
delete from facpaiement where id_fac=OLD.id_fac;
return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_update_delete_facture() OWNER TO imidsac;

--
-- Name: f_after_update_delete_vente(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_delete_vente() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
if TG_OP='UPDATE' then
update benefices_total set vente=vente+NEW.payee-OLD.payee, benefice=vente+NEW.payee-OLD.payee-achat-depence where extract(month from now()::date)=mois and extract(year from now()::date)=annee;
return NEW;
else
update benefices_total set vente=vente-OLD.payee, benefice=benefice-OLD.payee where extract(month from now()::date)=mois and extract(year from now()::date)=annee;
--delete from fpaiement where id_fo=OLD.id_fo and id_ac=OLD.id_ac;
return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_after_update_delete_vente() OWNER TO imidsac;

--
-- Name: f_after_update_depences(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_depences() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
moi integer;
an integer;
r record;
begin
select into r extract(year from NEW.date_dep) as annee;
an=r.annee;
select into r extract(month from NEW.date_dep) as m;
moi=r.m;
update benefices_total set depence=depence+NEW.montant-OLD.montant,benefice=benefice+OLD.montant-NEW.montant where annee=an and mois=moi;
return NEW;
end;$$;


ALTER FUNCTION public.f_after_update_depences() OWNER TO imidsac;

--
-- Name: f_after_update_em(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_em() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
m integer;
begin
if old.montant<>new.montant then

m=extract(month from now()::date);
         update epaiement set emontant=new.montant where annee=extract(year from now()::date) and id_em=NEW.id_em and mois>=extract(month from now()::date);
end if;
return New;
end ;$$;


ALTER FUNCTION public.f_after_update_em() OWNER TO imidsac;

--
-- Name: f_after_update_epaiement(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_after_update_epaiement() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
update benefices_total set depence=depence+NEW.payee-OLD.payee, benefice=vente-achat-(depence+NEW.payee-OLD.payee) where extract(month from now()::date)=mois and extract(year from now()::date)=annee;
return NEW;
end;$$;


ALTER FUNCTION public.f_after_update_epaiement() OWNER TO imidsac;

--
-- Name: f_annee(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_annee() RETURNS integer
    LANGUAGE plpgsql
    AS $$begin 

return(SELECT extract(year from now()::date));
end;$$;


ALTER FUNCTION public.f_annee() OWNER TO imidsac;

--
-- Name: f_befor_inser_update_achat_con(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_inser_update_achat_con() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
resultat record;
begin
if TG_OP='INSERT' then
        SELECT into r codesbase();
        --select into r prix_vente from articles where id_ar=NEW.id_ar;
        --NEW.prix_vente=r.prix_vente;
        NEW.montant=NEW.prix_achat*NEW.qt_ar;
return NEW;

elsif TG_OP='UPDATE' then
	select * into resultat from articles where id_ar=Old.id_ar;
	NEW.montant=NEW.prix_achat*NEW.qt_ar;
	--if old.qte_livres<>new.qte_livres and (new.qte_livres-old.qte_livres) > resultat.stoc_ar then
        --                                RAISE EXCEPTION 'Quantite non disponible dans le stock';
	if old.qte_livres<>new.qte_livres and new.qte_livres=0 then 
		new.etat='n';
	elsif old.qte_livres<>new.qte_livres and new.qte_livres=new.qt_ar then 
		new.etat='t';
	elsif old.qte_livres<>new.qte_livres and new.qte_livres>0 and new.qte_livres<new.qt_ar then 
		new.etat='p';
	end if; 
	if old.qt_ar<>new.qt_ar and old.etat='t' then 
                new.etat='p';
        end if;		
return NEW;

else
--select * into resultat from articles where id_ar=old.id_ar;
--if old.etat='p' or old.etat='t' and old.qte_livres > resultat.stoc_ar then
   --                 RAISE EXCEPTION 'Quantite non disponible dans le stock';

return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_befor_inser_update_achat_con() OWNER TO imidsac;

--
-- Name: f_befor_inser_update_cco(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_inser_update_cco() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
  select into r prix_vente from articles where id_ar=NEW.id_ar;
  NEW.prix_vente=r.prix_vente;
  NEW.montant=NEW.prix_vente*NEW.qt_ar;
  return NEW;
end;$$;


ALTER FUNCTION public.f_befor_inser_update_cco() OWNER TO imidsac;

--
-- Name: f_befor_inser_update_cfac(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_inser_update_cfac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
  select into r prix_vente from articles where id_ar=NEW.id_ar;
  --NEW.prix_vente=r.prix_vente;
  NEW.montant=NEW.prix_vente*NEW.qte_ar;
  return NEW;
end;$$;


ALTER FUNCTION public.f_befor_inser_update_cfac() OWNER TO imidsac;

--
-- Name: f_befor_inser_update_ventes_con(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_inser_update_ventes_con() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
  select into r prix_vente from articles where id_ar=NEW.id_ar;
  NEW.prix_vente=r.prix_vente;
  NEW.montant=NEW.prix_vente*NEW.qte_ar;
  return NEW;
end;$$;


ALTER FUNCTION public.f_befor_inser_update_ventes_con() OWNER TO imidsac;

--
-- Name: f_befor_insert_achat(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_insert_achat() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
select into r prix_achat from articles where id_ar=NEW.id_ar;
NEW.credit=NEW.qt_ar*r.prix_achat;
NEW.pu_ar=r.prix_achat;
--NEW.solde=NEW.credit-NEW.debit;
return NEW;
end;$$;


ALTER FUNCTION public.f_befor_insert_achat() OWNER TO imidsac;

--
-- Name: f_befor_insert_nom_bank(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_insert_nom_bank() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
--c record;
begin
select into r type, somme, solde from bamk where id_b=NEW.id_b;
--select into c type, somme from bamk where id_b=NEW.id_b;

if NEW.somme > r.solde then
if NEW.type='r' then
RAISE EXCEPTION 'Somme nom disponible';
end if;

if NEW.type ='r' then
  NEW.solde=r.solde-NEW.somme;
else
  NEW.solde=r.solde+NEW.somme;
 
 end if;
end if;

return NEW;
end;$$;


ALTER FUNCTION public.f_befor_insert_nom_bank() OWNER TO imidsac;

--
-- Name: f_befor_insert_update_delete_cfac(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_insert_update_delete_cfac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
resultat record;
begin
if TG_OP='INSERT' then
        SELECT into r codesbase();
        --select into r prix_vente from articles where id_ar=NEW.id_ar;
        --NEW.prix_vente=r.prix_vente;
        NEW.montant=NEW.prix_vente*NEW.qte_ar;
return NEW;

elsif TG_OP='UPDATE' then
	select * into resultat from articles where id_ar=Old.id_ar;
	NEW.montant=NEW.prix_vente*NEW.qte_ar;
	if old.qte_livres<>new.qte_livres and (new.qte_livres-old.qte_livres) > resultat.stoc_ar then
                                      --  RAISE EXCEPTION 'Quantite non disponible dans le stock';
return null;
	elsif old.qte_livres<>new.qte_livres and new.qte_livres=0 then 
		new.etat='n';
	elsif old.qte_livres<>new.qte_livres and new.qte_livres=new.qte_ar then 
		new.etat='t';
	elsif old.qte_livres<>new.qte_livres and new.qte_livres>0 and new.qte_livres<new.qte_ar then 
		new.etat='p';
	end if; 
	if old.qte_ar<>new.qte_ar and old.etat='t' then 
                new.etat='p';
        end if;		
return NEW;

else
return OLD;
end if;
end;$$;


ALTER FUNCTION public.f_befor_insert_update_delete_cfac() OWNER TO imidsac;

--
-- Name: f_befor_insert_vente(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_insert_vente() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
select into r prix_vente, stoc_ar from articles where id_ar = NEW.id_ar;
NEW.pu_ar=r.prix_vente;
NEW.credit=NEW.qt_ar*r.prix_vente;
if r.stoc_ar - NEW.qt_ar<0 then
RAISE EXCEPTION 'Quantité nom disponible';
end if;
--select into r max(num_vente) as m from ventes;
--if NEW.etat='n' then
--  NEW.num_vente=r.m+1;
--else
 -- NEW.num_vente=r.m;
--end if;
--NEW.credit=NEW.qt_ar*r.prix_vente;*/
return NEW;
end;$$;


ALTER FUNCTION public.f_befor_insert_vente() OWNER TO imidsac;

--
-- Name: f_befor_insert_verait(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_insert_verait() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin
select into r solde from bamk where id_b = NEW.id_b;
if NEW.type='r' then
if r.solde - NEW.somme<0 then
RAISE EXCEPTION 'Quantité nom disponible';
end if;
end if;
return NEW;
end;$$;


ALTER FUNCTION public.f_befor_insert_verait() OWNER TO imidsac;

--
-- Name: f_befor_update_achat(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_update_achat() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
NEW.reste=NEW.somme-NEW.payee;
return NEW;
end;$$;


ALTER FUNCTION public.f_befor_update_achat() OWNER TO imidsac;

--
-- Name: f_befor_update_ccom(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_update_ccom() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare

resultat record;
begin
 select * into resultat from articles where id_ar=Old.id_ar;
  if New.qt_ar > resultat.stoc_ar and NEW.etat=1 then
       RAISE EXCEPTION 'Quantite non disponible dans le stock';
   end if;
return new; 
end;$$;


ALTER FUNCTION public.f_befor_update_ccom() OWNER TO imidsac;

--
-- Name: f_befor_update_cfac(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_update_cfac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare

resultat record;
begin
 select * into resultat from articles where id_ar=Old.id_ar;
if new.qte_livres>old.qte_livres then
  if New.qte_livres > resultat.stoc_ar then
       RAISE EXCEPTION 'Quantite non disponible dans le stock';
   end if;
end if;
return new; 
end;$$;


ALTER FUNCTION public.f_befor_update_cfac() OWNER TO imidsac;

--
-- Name: f_befor_update_cfac1(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_update_cfac1() RETURNS trigger
    LANGUAGE plpgsql
    AS $$declare
r record;
begin

   if OLD.etat<>NEW.etat and NEW.etat='t' then
       NEW.qte_livres=old.qte_ar;
       NEW.qte_rlivres=0;
      end if; 

NEW.qte_livres=old.qte_livres+NEW.qte_livres-old.qte_livres;
NEW.qte_rlivres=NEW.qte_ar-NEW.qte_livres;
  if new.qte_livres<>old.qte_livres and new.qte_livres<new.qte_ar and new.qte_livres!=0 then
      NEW.etat='p';
  end if; 
  
  if new.qte_livres=new.qte_ar then
     NEW.etat='t';
  end if; 
  if new.qte_livres=0 then
  NEW.etat='n';
  end if;
  --elsif new.etat='t' then
  --new.qte_livres=new.qte_ar;
  --end if;
  

return new;
end;$$;


ALTER FUNCTION public.f_befor_update_cfac1() OWNER TO imidsac;

--
-- Name: f_befor_update_commandes(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_update_commandes() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
NEW.reste=NEW.somme-NEW.payee;
return NEW;
end;$$;


ALTER FUNCTION public.f_befor_update_commandes() OWNER TO imidsac;

--
-- Name: f_befor_update_facture(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_update_facture() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
NEW.reste=NEW.somme-NEW.payee;
return NEW;
end;$$;


ALTER FUNCTION public.f_befor_update_facture() OWNER TO imidsac;

--
-- Name: f_befor_update_ventes(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_befor_update_ventes() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
NEW.reste=NEW.somme-NEW.payee;
return NEW;
end;$$;


ALTER FUNCTION public.f_befor_update_ventes() OWNER TO imidsac;

--
-- Name: f_before_insert_boutiques(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_before_insert_boutiques() RETURNS trigger
    LANGUAGE plpgsql
    AS $$begin
insert into exercices(annee,id_bo) values(extract(year from now()),NEW.id_bo);
return NEW;
end;$$;


ALTER FUNCTION public.f_before_insert_boutiques() OWNER TO imidsac;

--
-- Name: f_insert(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION f_insert() RETURNS integer
    LANGUAGE plpgsql
    AS $$begin
for i in 13..17 loop
         insert into epaiement(annee,mois,id_em,emontant) values(2012,1,i,0);
      end loop;
return 1;
end ;$$;


ALTER FUNCTION public.f_insert() OWNER TO imidsac;

--
-- Name: get_prix_ar(integer); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION get_prix_ar(integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$begin
return(SELECT prix_achat from articles where id_ar=$1);
end;$_$;


ALTER FUNCTION public.get_prix_ar(integer) OWNER TO imidsac;

--
-- Name: init_benefice(integer); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION init_benefice(an integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$declare
r record;
begin
for r in select  * from articles loop
      for i in 1..12 loop
         insert into benefices(annee,mois,id_ar,achat,vente,benefice) values($1,i,r.id_ar,0,0,0);
      end loop;
end loop;
return 1;
end ;$_$;


ALTER FUNCTION public.init_benefice(an integer) OWNER TO imidsac;

--
-- Name: init_benefice_total(integer); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION init_benefice_total(ann integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$begin
      for i in 1..12 loop
         insert into benefices_total(annee,mois,depence,achat,vente,benefice) values($1,i,0,0,0,0);
      end loop;
return 1;
end ;

$_$;


ALTER FUNCTION public.init_benefice_total(ann integer) OWNER TO imidsac;

--
-- Name: init_epaiement(); Type: FUNCTION; Schema: public; Owner: imidsac
--

CREATE FUNCTION init_epaiement() RETURNS integer
    LANGUAGE plpgsql
    AS $$declare
r record;
v record;
begin

for v in select  id_em, montant from employer
loop
      for i in 1..12 loop
         insert into epaiement(annee,mois,id_em,emontant) values(f_annee(),i,v.id_em,v.montant);
      end loop;
end loop;
return 1;
end ;

$$;


ALTER FUNCTION public.init_epaiement() OWNER TO imidsac;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: achat; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE achat (
    id_ac integer NOT NULL,
    id_fo integer,
    date_1 timestamp without time zone DEFAULT (now())::date,
    date_2 timestamp without time zone DEFAULT (now())::date,
    etat_ac character(1) DEFAULT 'n'::bpchar,
    somme integer DEFAULT 0,
    payee integer DEFAULT 0,
    reste integer DEFAULT 0
);


ALTER TABLE public.achat OWNER TO imidsac;

--
-- Name: achat_con; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE achat_con (
    id_ac integer NOT NULL,
    id_ar integer NOT NULL,
    qt_ar integer,
    prix_achat integer DEFAULT 0,
    montant integer DEFAULT 0,
    etat character(1) DEFAULT 'n'::bpchar,
    qte_livres integer DEFAULT 0
);


ALTER TABLE public.achat_con OWNER TO imidsac;

--
-- Name: achat_id_ac_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE achat_id_ac_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.achat_id_ac_seq OWNER TO imidsac;

--
-- Name: achat_id_ac_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE achat_id_ac_seq OWNED BY achat.id_ac;


--
-- Name: articles; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE articles (
    id_ar integer NOT NULL,
    lib_ar character varying(150) NOT NULL,
    type_ar character varying(100),
    prix_achat integer,
    prix_vente integer,
    info text,
    etat character(1) DEFAULT 'a'::bpchar NOT NULL
);


ALTER TABLE public.articles OWNER TO imidsac;

--
-- Name: articles_id_ar_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE articles_id_ar_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.articles_id_ar_seq OWNER TO imidsac;

--
-- Name: articles_id_ar_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE articles_id_ar_seq OWNED BY articles.id_ar;


--
-- Name: bamk; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE bamk (
    id_b integer NOT NULL,
    designation character varying(15) DEFAULT 'BDM'::character varying,
    compte_banc character varying(50) DEFAULT 'XX XX XX XX XX'::character varying,
    solde integer DEFAULT 0
);


ALTER TABLE public.bamk OWNER TO imidsac;

--
-- Name: bamk_id_b_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE bamk_id_b_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bamk_id_b_seq OWNER TO imidsac;

--
-- Name: bamk_id_b_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE bamk_id_b_seq OWNED BY bamk.id_b;


--
-- Name: benefices; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE benefices (
    annee integer,
    mois integer,
    id_ar integer,
    achat integer,
    vente integer,
    benefice integer,
    CONSTRAINT benefices_check CHECK (((achat >= 0) AND (vente >= 0)))
);


ALTER TABLE public.benefices OWNER TO imidsac;

--
-- Name: benefices_total; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE benefices_total (
    annee integer,
    mois integer,
    depence integer,
    achat integer,
    vente integer,
    benefice integer,
    id_bo integer NOT NULL,
    CONSTRAINT benefices_total_check CHECK ((((achat >= 0) AND (vente >= 0)) AND (depence >= 0)))
);


ALTER TABLE public.benefices_total OWNER TO imidsac;

--
-- Name: boutiques; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE boutiques (
    id_bo integer NOT NULL,
    nom_bo character varying(50) NOT NULL,
    id_vi integer NOT NULL,
    adr_bo character varying(100),
    tel_bo character varying(50),
    info_bo character varying(200),
    email character varying(40),
    capital integer,
    logo character varying(20),
    nb_em integer DEFAULT 0 NOT NULL,
    tmontant_em integer DEFAULT 0 NOT NULL,
    CONSTRAINT boutiques_check CHECK ((((capital > 0) AND (nb_em >= 0)) AND (tmontant_em >= 0)))
);


ALTER TABLE public.boutiques OWNER TO imidsac;

--
-- Name: boutiques_id_bo_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE boutiques_id_bo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.boutiques_id_bo_seq OWNER TO imidsac;

--
-- Name: boutiques_id_bo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE boutiques_id_bo_seq OWNED BY boutiques.id_bo;


--
-- Name: caisses; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE caisses (
    annee integer,
    id_bo integer,
    solde integer DEFAULT 0 NOT NULL,
    amontant integer DEFAULT 0 NOT NULL,
    dmontant integer DEFAULT 0 NOT NULL,
    CONSTRAINT caisses_check CHECK (((amontant >= 0) AND (dmontant >= 0)))
);


ALTER TABLE public.caisses OWNER TO imidsac;

--
-- Name: ccommandes; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE ccommandes (
    id_co integer NOT NULL,
    id_ar integer NOT NULL,
    qt_ar integer,
    etat integer DEFAULT 0,
    prix_vente integer DEFAULT 0,
    montant integer DEFAULT 0,
    CONSTRAINT ccommandes_etat_check CHECK ((etat = ANY (ARRAY[0, 1])))
);


ALTER TABLE public.ccommandes OWNER TO imidsac;

--
-- Name: clients; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE clients (
    id_cl integer NOT NULL,
    nom_cl character varying(20) NOT NULL,
    prenom_cl character varying(20) NOT NULL,
    add_cl character varying(40),
    tel1_cl character varying(40) DEFAULT 'xx xx xx xx'::character varying,
    email character varying(60) DEFAULT 'exemple555@exemple.com'::character varying,
    id_bo integer NOT NULL
);


ALTER TABLE public.clients OWNER TO imidsac;

--
-- Name: clients_id_cl_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE clients_id_cl_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clients_id_cl_seq OWNER TO imidsac;

--
-- Name: clients_id_cl_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE clients_id_cl_seq OWNED BY clients.id_cl;


--
-- Name: commandes; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE commandes (
    id_co integer NOT NULL,
    id_cl integer,
    date1 timestamp without time zone DEFAULT (now())::date,
    date2 timestamp without time zone DEFAULT (now())::date,
    etat_co integer DEFAULT 0,
    somme integer DEFAULT 0,
    payee integer DEFAULT 0,
    reste integer DEFAULT 0,
    CONSTRAINT commandes_etat_co_check CHECK ((etat_co = ANY (ARRAY[0, 1, 2])))
);


ALTER TABLE public.commandes OWNER TO imidsac;

--
-- Name: commandes_id_co_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE commandes_id_co_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commandes_id_co_seq OWNER TO imidsac;

--
-- Name: commandes_id_co_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE commandes_id_co_seq OWNED BY commandes.id_co;


--
-- Name: cpaiement; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE cpaiement (
    id_cp integer NOT NULL,
    id_co integer,
    id_cl integer,
    date_cp timestamp without time zone DEFAULT (now())::date,
    motif character varying(60),
    montant integer DEFAULT 0
);


ALTER TABLE public.cpaiement OWNER TO imidsac;

--
-- Name: cpaiement_id_cp_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE cpaiement_id_cp_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cpaiement_id_cp_seq OWNER TO imidsac;

--
-- Name: cpaiement_id_cp_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE cpaiement_id_cp_seq OWNED BY cpaiement.id_cp;


--
-- Name: depences; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE depences (
    id_dep integer NOT NULL,
    lib_dep character varying(50) NOT NULL,
    date_dep timestamp without time zone DEFAULT (now())::date,
    montant integer,
    id_bo integer NOT NULL,
    annee integer DEFAULT f_annee() NOT NULL,
    CONSTRAINT depences_montant_check CHECK ((montant >= 0))
);


ALTER TABLE public.depences OWNER TO imidsac;

--
-- Name: depences_id_dep_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE depences_id_dep_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.depences_id_dep_seq OWNER TO imidsac;

--
-- Name: depences_id_dep_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE depences_id_dep_seq OWNED BY depences.id_dep;


--
-- Name: employer; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE employer (
    id_em integer NOT NULL,
    nom_em character varying(20) NOT NULL,
    prenom_em character varying(20) NOT NULL,
    add_em character varying(40),
    tel1_em character varying(15) DEFAULT 'xx xx xx xx'::character varying,
    tel2_em character varying(15) DEFAULT 'xx xx xx xx'::character varying,
    montant integer DEFAULT 0 NOT NULL,
    statu character varying(50),
    sexe character(1) DEFAULT 'm'::bpchar,
    email character varying(50) DEFAULT 'exemple555@exmple.ex'::character varying,
    compte_banc character varying(50)
);


ALTER TABLE public.employer OWNER TO imidsac;

--
-- Name: employer_id_em_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE employer_id_em_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employer_id_em_seq OWNER TO imidsac;

--
-- Name: employer_id_em_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE employer_id_em_seq OWNED BY employer.id_em;


--
-- Name: epaiement; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE epaiement (
    id_ep integer NOT NULL,
    id_em integer,
    annee integer,
    mois integer,
    emontant integer,
    payee integer DEFAULT 0,
    etat integer DEFAULT 0
);


ALTER TABLE public.epaiement OWNER TO imidsac;

--
-- Name: epaiement_id_ep_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE epaiement_id_ep_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.epaiement_id_ep_seq OWNER TO imidsac;

--
-- Name: epaiement_id_ep_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE epaiement_id_ep_seq OWNED BY epaiement.id_ep;


--
-- Name: exercices; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE exercices (
    annee integer NOT NULL,
    etat character(1) DEFAULT 'n'::bpchar NOT NULL,
    id_bo integer NOT NULL
);


ALTER TABLE public.exercices OWNER TO imidsac;

--
-- Name: facpaiement; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE facpaiement (
    id_facp integer NOT NULL,
    id_fac integer,
    date_facp timestamp without time zone DEFAULT (now())::date,
    motif character varying(60),
    montant integer DEFAULT 0
);


ALTER TABLE public.facpaiement OWNER TO imidsac;

--
-- Name: facpaiement_id_facp_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE facpaiement_id_facp_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facpaiement_id_facp_seq OWNER TO imidsac;

--
-- Name: facpaiement_id_facp_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE facpaiement_id_facp_seq OWNED BY facpaiement.id_facp;


--
-- Name: facture; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE facture (
    id_fac integer NOT NULL,
    date_fac timestamp without time zone DEFAULT (now())::date,
    client character varying(30),
    etat_fac character(1) DEFAULT 'n'::bpchar,
    payee integer DEFAULT 0,
    reste integer DEFAULT 0,
    somme integer DEFAULT 0,
    id_bo integer NOT NULL
);


ALTER TABLE public.facture OWNER TO imidsac;

--
-- Name: facture_con; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE facture_con (
    id_fac integer NOT NULL,
    id_ar integer NOT NULL,
    qte_ar integer,
    etat character(1) DEFAULT 'n'::bpchar,
    prix_vente integer DEFAULT 0,
    montant integer DEFAULT 0,
    qte_livres integer DEFAULT 0,
    CONSTRAINT facture_con_check CHECK ((qte_livres <= qte_ar)),
    CONSTRAINT facture_con_etat_check CHECK ((etat = ANY (ARRAY['n'::bpchar, 't'::bpchar, 'p'::bpchar])))
);


ALTER TABLE public.facture_con OWNER TO imidsac;

--
-- Name: facture_id_fac_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE facture_id_fac_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.facture_id_fac_seq OWNER TO imidsac;

--
-- Name: facture_id_fac_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE facture_id_fac_seq OWNED BY facture.id_fac;


--
-- Name: fournisseur; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE fournisseur (
    id_fo integer NOT NULL,
    nom_fo character varying(30) NOT NULL,
    add_fo character varying(40),
    email character varying(60) DEFAULT 'exemple555@exemple.com'::character varying,
    tel1_fo character varying(20) DEFAULT 'xx xx xx xx'::character varying,
    tel2_fo character varying(20) DEFAULT 'xx xx xx xx'::character varying
);


ALTER TABLE public.fournisseur OWNER TO imidsac;

--
-- Name: fournisseur_id_fo_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE fournisseur_id_fo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fournisseur_id_fo_seq OWNER TO imidsac;

--
-- Name: fournisseur_id_fo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE fournisseur_id_fo_seq OWNED BY fournisseur.id_fo;


--
-- Name: fpaiement; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE fpaiement (
    id_fp integer NOT NULL,
    id_fo integer,
    date_fp timestamp without time zone DEFAULT (now())::date,
    motif character varying(60),
    montant integer DEFAULT 0,
    id_ac integer
);


ALTER TABLE public.fpaiement OWNER TO imidsac;

--
-- Name: fpaiement_id_fp_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE fpaiement_id_fp_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fpaiement_id_fp_seq OWNER TO imidsac;

--
-- Name: fpaiement_id_fp_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE fpaiement_id_fp_seq OWNED BY fpaiement.id_fp;


--
-- Name: gdepenses; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE gdepenses (
    annee integer NOT NULL,
    mois integer NOT NULL,
    id_bo integer NOT NULL,
    montant integer DEFAULT 0
);


ALTER TABLE public.gdepenses OWNER TO imidsac;

--
-- Name: produits; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE produits (
    id_pr integer NOT NULL,
    id_ar integer NOT NULL,
    id_bo integer NOT NULL,
    pachat integer DEFAULT 0 NOT NULL,
    pvente integer DEFAULT 0 NOT NULL,
    stock integer DEFAULT 0 NOT NULL,
    etat character(1) DEFAULT 'a'::bpchar NOT NULL,
    tva character(1) DEFAULT 0 NOT NULL
);


ALTER TABLE public.produits OWNER TO imidsac;

--
-- Name: produits_id_pr_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE produits_id_pr_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produits_id_pr_seq OWNER TO imidsac;

--
-- Name: produits_id_pr_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE produits_id_pr_seq OWNED BY produits.id_pr;


--
-- Name: tepaiement; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE tepaiement (
    id_tep integer NOT NULL,
    id_em integer,
    date_tep timestamp without time zone DEFAULT (now())::date,
    motif character varying(60) DEFAULT 'ESPECE'::character varying,
    montant integer DEFAULT 0,
    id_ep integer
);


ALTER TABLE public.tepaiement OWNER TO imidsac;

--
-- Name: tepaiement_id_tep_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE tepaiement_id_tep_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tepaiement_id_tep_seq OWNER TO imidsac;

--
-- Name: tepaiement_id_tep_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE tepaiement_id_tep_seq OWNED BY tepaiement.id_tep;


--
-- Name: transferts; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE transferts (
    id_tr integer NOT NULL,
    date_tr date DEFAULT (now())::date,
    id_ar integer NOT NULL,
    qte_ar integer NOT NULL,
    prix_ar integer NOT NULL,
    id_bo integer NOT NULL,
    annee integer NOT NULL,
    CONSTRAINT transferts_prix_ar_check CHECK ((prix_ar > 0)),
    CONSTRAINT transferts_qte_ar_check CHECK ((qte_ar > 0))
);


ALTER TABLE public.transferts OWNER TO imidsac;

--
-- Name: transferts_id_tr_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE transferts_id_tr_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.transferts_id_tr_seq OWNER TO imidsac;

--
-- Name: transferts_id_tr_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE transferts_id_tr_seq OWNED BY transferts.id_tr;


--
-- Name: utilisateurs; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE utilisateurs (
    id_user integer NOT NULL,
    login character varying(50),
    pass character varying(50),
    nom character varying(50),
    prenom character varying(50),
    privilege character varying(50),
    gid integer,
    gecos character varying(100),
    id_bo integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.utilisateurs OWNER TO imidsac;

--
-- Name: utilisateurs_id_user_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE utilisateurs_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilisateurs_id_user_seq OWNER TO imidsac;

--
-- Name: utilisateurs_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE utilisateurs_id_user_seq OWNED BY utilisateurs.id_user;


--
-- Name: ventes; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE ventes (
    id_ve integer NOT NULL,
    date_ve timestamp without time zone DEFAULT (now())::date,
    client character varying(30),
    somme integer DEFAULT 0,
    etat_ve integer DEFAULT 0,
    payee integer DEFAULT 0,
    reste integer DEFAULT 0
);


ALTER TABLE public.ventes OWNER TO imidsac;

--
-- Name: ventes_con; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE ventes_con (
    id_ve integer NOT NULL,
    id_ar integer NOT NULL,
    qte_ar integer,
    etat integer DEFAULT 0,
    prix_vente integer DEFAULT 0,
    montant integer DEFAULT 0
);


ALTER TABLE public.ventes_con OWNER TO imidsac;

--
-- Name: ventes_id_ve_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE ventes_id_ve_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ventes_id_ve_seq OWNER TO imidsac;

--
-- Name: ventes_id_ve_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE ventes_id_ve_seq OWNED BY ventes.id_ve;


--
-- Name: verait; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE verait (
    date_vr timestamp without time zone DEFAULT (now())::date,
    type character(1) DEFAULT 'v'::bpchar,
    somme integer,
    id_b integer
);


ALTER TABLE public.verait OWNER TO imidsac;

--
-- Name: villes; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE villes (
    id_vi integer NOT NULL,
    nom_ville character varying(30) NOT NULL,
    nom_pays character varying(20) DEFAULT 'Mali'::character varying
);


ALTER TABLE public.villes OWNER TO imidsac;

--
-- Name: villes_id_vi_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE villes_id_vi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.villes_id_vi_seq OWNER TO imidsac;

--
-- Name: villes_id_vi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE villes_id_vi_seq OWNED BY villes.id_vi;


--
-- Name: vpaiement; Type: TABLE; Schema: public; Owner: imidsac; Tablespace: 
--

CREATE TABLE vpaiement (
    id_vp integer NOT NULL,
    id_ve integer,
    date_vp timestamp without time zone DEFAULT (now())::date,
    motif character varying(60),
    montant integer DEFAULT 0
);


ALTER TABLE public.vpaiement OWNER TO imidsac;

--
-- Name: vpaiement_id_vp_seq; Type: SEQUENCE; Schema: public; Owner: imidsac
--

CREATE SEQUENCE vpaiement_id_vp_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vpaiement_id_vp_seq OWNER TO imidsac;

--
-- Name: vpaiement_id_vp_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: imidsac
--

ALTER SEQUENCE vpaiement_id_vp_seq OWNED BY vpaiement.id_vp;


--
-- Name: id_ac; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY achat ALTER COLUMN id_ac SET DEFAULT nextval('achat_id_ac_seq'::regclass);


--
-- Name: id_ar; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY articles ALTER COLUMN id_ar SET DEFAULT nextval('articles_id_ar_seq'::regclass);


--
-- Name: id_b; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY bamk ALTER COLUMN id_b SET DEFAULT nextval('bamk_id_b_seq'::regclass);


--
-- Name: id_bo; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY boutiques ALTER COLUMN id_bo SET DEFAULT nextval('boutiques_id_bo_seq'::regclass);


--
-- Name: id_cl; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY clients ALTER COLUMN id_cl SET DEFAULT nextval('clients_id_cl_seq'::regclass);


--
-- Name: id_co; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY commandes ALTER COLUMN id_co SET DEFAULT nextval('commandes_id_co_seq'::regclass);


--
-- Name: id_cp; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY cpaiement ALTER COLUMN id_cp SET DEFAULT nextval('cpaiement_id_cp_seq'::regclass);


--
-- Name: id_dep; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY depences ALTER COLUMN id_dep SET DEFAULT nextval('depences_id_dep_seq'::regclass);


--
-- Name: id_em; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY employer ALTER COLUMN id_em SET DEFAULT nextval('employer_id_em_seq'::regclass);


--
-- Name: id_ep; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY epaiement ALTER COLUMN id_ep SET DEFAULT nextval('epaiement_id_ep_seq'::regclass);


--
-- Name: id_facp; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY facpaiement ALTER COLUMN id_facp SET DEFAULT nextval('facpaiement_id_facp_seq'::regclass);


--
-- Name: id_fac; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY facture ALTER COLUMN id_fac SET DEFAULT nextval('facture_id_fac_seq'::regclass);


--
-- Name: id_fo; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY fournisseur ALTER COLUMN id_fo SET DEFAULT nextval('fournisseur_id_fo_seq'::regclass);


--
-- Name: id_fp; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY fpaiement ALTER COLUMN id_fp SET DEFAULT nextval('fpaiement_id_fp_seq'::regclass);


--
-- Name: id_pr; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY produits ALTER COLUMN id_pr SET DEFAULT nextval('produits_id_pr_seq'::regclass);


--
-- Name: id_tep; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY tepaiement ALTER COLUMN id_tep SET DEFAULT nextval('tepaiement_id_tep_seq'::regclass);


--
-- Name: id_tr; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY transferts ALTER COLUMN id_tr SET DEFAULT nextval('transferts_id_tr_seq'::regclass);


--
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY utilisateurs ALTER COLUMN id_user SET DEFAULT nextval('utilisateurs_id_user_seq'::regclass);


--
-- Name: id_ve; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY ventes ALTER COLUMN id_ve SET DEFAULT nextval('ventes_id_ve_seq'::regclass);


--
-- Name: id_vi; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY villes ALTER COLUMN id_vi SET DEFAULT nextval('villes_id_vi_seq'::regclass);


--
-- Name: id_vp; Type: DEFAULT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY vpaiement ALTER COLUMN id_vp SET DEFAULT nextval('vpaiement_id_vp_seq'::regclass);


--
-- Data for Name: achat; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY achat (id_ac, id_fo, date_1, date_2, etat_ac, somme, payee, reste) FROM stdin;
\.


--
-- Data for Name: achat_con; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY achat_con (id_ac, id_ar, qt_ar, prix_achat, montant, etat, qte_livres) FROM stdin;
\.


--
-- Name: achat_id_ac_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('achat_id_ac_seq', 1, false);


--
-- Data for Name: articles; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY articles (id_ar, lib_ar, type_ar, prix_achat, prix_vente, info, etat) FROM stdin;
5	Baramusso	15g	\N	100	\N	a
6	Baramusso	30g	\N	200	\N	a
\.


--
-- Name: articles_id_ar_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('articles_id_ar_seq', 6, true);


--
-- Data for Name: bamk; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY bamk (id_b, designation, compte_banc, solde) FROM stdin;
\.


--
-- Name: bamk_id_b_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('bamk_id_b_seq', 1, false);


--
-- Data for Name: benefices; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY benefices (annee, mois, id_ar, achat, vente, benefice) FROM stdin;
\.


--
-- Data for Name: benefices_total; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY benefices_total (annee, mois, depence, achat, vente, benefice, id_bo) FROM stdin;
2013	1	\N	\N	\N	\N	8
2013	2	\N	\N	\N	\N	8
2013	3	\N	\N	\N	\N	8
2013	4	\N	\N	\N	\N	8
2013	5	\N	\N	\N	\N	8
2013	6	\N	\N	\N	\N	8
2013	7	\N	\N	\N	\N	8
2013	8	\N	\N	\N	\N	8
2013	9	\N	\N	\N	\N	8
2013	10	\N	\N	\N	\N	8
2013	11	\N	\N	\N	\N	8
2013	12	\N	\N	\N	\N	8
2013	1	\N	\N	\N	\N	9
2013	2	\N	\N	\N	\N	9
2013	3	\N	\N	\N	\N	9
2013	4	\N	\N	\N	\N	9
2013	5	\N	\N	\N	\N	9
2013	6	\N	\N	\N	\N	9
2013	7	\N	\N	\N	\N	9
2013	8	\N	\N	\N	\N	9
2013	9	\N	\N	\N	\N	9
2013	10	\N	\N	\N	\N	9
2013	11	\N	\N	\N	\N	9
2013	12	\N	\N	\N	\N	9
\.


--
-- Data for Name: boutiques; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY boutiques (id_bo, nom_bo, id_vi, adr_bo, tel_bo, info_bo, email, capital, logo, nb_em, tmontant_em) FROM stdin;
1	Direction Générale	1	\N	\N	\N	\N	\N	\N	0	0
2	Saramaya	2	\N	\N	\N	\N	\N	\N	0	0
3	Wayerma	3	\N	\N	\N	\N	\N	\N	0	0
8	Soumbala	4	\N	\N	\N	\N	\N	\N	0	0
9	kkkkkkk	5	\N	\N	\N	\N	\N	\N	0	0
\.


--
-- Name: boutiques_id_bo_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('boutiques_id_bo_seq', 10, true);


--
-- Data for Name: caisses; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY caisses (annee, id_bo, solde, amontant, dmontant) FROM stdin;
2013	8	0	0	0
2013	9	0	0	0
\.


--
-- Data for Name: ccommandes; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY ccommandes (id_co, id_ar, qt_ar, etat, prix_vente, montant) FROM stdin;
\.


--
-- Data for Name: clients; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY clients (id_cl, nom_cl, prenom_cl, add_cl, tel1_cl, email, id_bo) FROM stdin;
\.


--
-- Name: clients_id_cl_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('clients_id_cl_seq', 1, false);


--
-- Data for Name: commandes; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY commandes (id_co, id_cl, date1, date2, etat_co, somme, payee, reste) FROM stdin;
\.


--
-- Name: commandes_id_co_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('commandes_id_co_seq', 1, false);


--
-- Data for Name: cpaiement; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY cpaiement (id_cp, id_co, id_cl, date_cp, motif, montant) FROM stdin;
\.


--
-- Name: cpaiement_id_cp_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('cpaiement_id_cp_seq', 1, false);


--
-- Data for Name: depences; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY depences (id_dep, lib_dep, date_dep, montant, id_bo, annee) FROM stdin;
\.


--
-- Name: depences_id_dep_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('depences_id_dep_seq', 2, true);


--
-- Data for Name: employer; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY employer (id_em, nom_em, prenom_em, add_em, tel1_em, tel2_em, montant, statu, sexe, email, compte_banc) FROM stdin;
\.


--
-- Name: employer_id_em_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('employer_id_em_seq', 1, false);


--
-- Data for Name: epaiement; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY epaiement (id_ep, id_em, annee, mois, emontant, payee, etat) FROM stdin;
\.


--
-- Name: epaiement_id_ep_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('epaiement_id_ep_seq', 1, false);


--
-- Data for Name: exercices; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY exercices (annee, etat, id_bo) FROM stdin;
2013	n	9
2013	n	10
\.


--
-- Data for Name: facpaiement; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY facpaiement (id_facp, id_fac, date_facp, motif, montant) FROM stdin;
\.


--
-- Name: facpaiement_id_facp_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('facpaiement_id_facp_seq', 1, false);


--
-- Data for Name: facture; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY facture (id_fac, date_fac, client, etat_fac, payee, reste, somme, id_bo) FROM stdin;
\.


--
-- Data for Name: facture_con; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY facture_con (id_fac, id_ar, qte_ar, etat, prix_vente, montant, qte_livres) FROM stdin;
\.


--
-- Name: facture_id_fac_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('facture_id_fac_seq', 1, false);


--
-- Data for Name: fournisseur; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY fournisseur (id_fo, nom_fo, add_fo, email, tel1_fo, tel2_fo) FROM stdin;
\.


--
-- Name: fournisseur_id_fo_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('fournisseur_id_fo_seq', 1, false);


--
-- Data for Name: fpaiement; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY fpaiement (id_fp, id_fo, date_fp, motif, montant, id_ac) FROM stdin;
\.


--
-- Name: fpaiement_id_fp_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('fpaiement_id_fp_seq', 1, false);


--
-- Data for Name: gdepenses; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY gdepenses (annee, mois, id_bo, montant) FROM stdin;
2013	1	8	0
2013	2	8	0
2013	3	8	0
2013	4	8	0
2013	5	8	0
2013	6	8	0
2013	7	8	0
2013	8	8	0
2013	9	8	0
2013	10	8	0
2013	11	8	0
2013	12	8	0
2013	1	9	0
2013	2	9	0
2013	3	9	0
2013	4	9	0
2013	5	9	0
2013	6	9	0
2013	7	9	0
2013	8	9	0
2013	9	9	0
2013	10	9	0
2013	11	9	0
2013	12	9	0
\.


--
-- Data for Name: produits; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY produits (id_pr, id_ar, id_bo, pachat, pvente, stock, etat, tva) FROM stdin;
4	5	1	0	100	0	a	0
5	5	2	0	100	0	a	0
6	5	3	0	100	0	a	0
7	6	1	0	200	0	a	0
8	6	2	0	200	0	a	0
9	6	3	0	200	0	a	0
16	5	8	0	100	0	a	0
17	6	8	0	200	0	a	0
18	5	9	0	100	0	a	0
19	6	9	0	200	0	a	0
\.


--
-- Name: produits_id_pr_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('produits_id_pr_seq', 21, true);


--
-- Data for Name: tepaiement; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY tepaiement (id_tep, id_em, date_tep, motif, montant, id_ep) FROM stdin;
\.


--
-- Name: tepaiement_id_tep_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('tepaiement_id_tep_seq', 1, false);


--
-- Data for Name: transferts; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY transferts (id_tr, date_tr, id_ar, qte_ar, prix_ar, id_bo, annee) FROM stdin;
\.


--
-- Name: transferts_id_tr_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('transferts_id_tr_seq', 1, false);


--
-- Data for Name: utilisateurs; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY utilisateurs (id_user, login, pass, nom, prenom, privilege, gid, gecos, id_bo) FROM stdin;
1	admin	d5a60b388f24fbfd0139f4e5f09ede12	SACKO	Idiriss	admin	\N	Informaticien	1
\.


--
-- Name: utilisateurs_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('utilisateurs_id_user_seq', 1, true);


--
-- Data for Name: ventes; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY ventes (id_ve, date_ve, client, somme, etat_ve, payee, reste) FROM stdin;
\.


--
-- Data for Name: ventes_con; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY ventes_con (id_ve, id_ar, qte_ar, etat, prix_vente, montant) FROM stdin;
\.


--
-- Name: ventes_id_ve_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('ventes_id_ve_seq', 1, false);


--
-- Data for Name: verait; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY verait (date_vr, type, somme, id_b) FROM stdin;
\.


--
-- Data for Name: villes; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY villes (id_vi, nom_ville, nom_pays) FROM stdin;
1	Mali	Bamako
2	Mali	Kayes
3	Mali	Sikasso
4	Mali	Segou
5	Sénégale	Dakar
6	Burkina	Wagua
\.


--
-- Name: villes_id_vi_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('villes_id_vi_seq', 6, true);


--
-- Data for Name: vpaiement; Type: TABLE DATA; Schema: public; Owner: imidsac
--

COPY vpaiement (id_vp, id_ve, date_vp, motif, montant) FROM stdin;
\.


--
-- Name: vpaiement_id_vp_seq; Type: SEQUENCE SET; Schema: public; Owner: imidsac
--

SELECT pg_catalog.setval('vpaiement_id_vp_seq', 1, false);


--
-- Name: achat_con_id_ac_id_ar_key; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY achat_con
    ADD CONSTRAINT achat_con_id_ac_id_ar_key UNIQUE (id_ac, id_ar);


--
-- Name: achat_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY achat
    ADD CONSTRAINT achat_pkey PRIMARY KEY (id_ac);


--
-- Name: articles_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY articles
    ADD CONSTRAINT articles_pkey PRIMARY KEY (id_ar);


--
-- Name: bamk_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY bamk
    ADD CONSTRAINT bamk_pkey PRIMARY KEY (id_b);


--
-- Name: benefices_annee_key; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY benefices
    ADD CONSTRAINT benefices_annee_key UNIQUE (annee, mois, id_ar);


--
-- Name: boutiques_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY boutiques
    ADD CONSTRAINT boutiques_pkey PRIMARY KEY (id_bo);


--
-- Name: caisses_annee_key; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY caisses
    ADD CONSTRAINT caisses_annee_key UNIQUE (annee, id_bo);


--
-- Name: ccommandes_id_co_key; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY ccommandes
    ADD CONSTRAINT ccommandes_id_co_key UNIQUE (id_co, id_ar);


--
-- Name: clients_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY clients
    ADD CONSTRAINT clients_pkey PRIMARY KEY (id_cl);


--
-- Name: commandes_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY commandes
    ADD CONSTRAINT commandes_pkey PRIMARY KEY (id_co);


--
-- Name: cpaiement_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY cpaiement
    ADD CONSTRAINT cpaiement_pkey PRIMARY KEY (id_cp);


--
-- Name: depences_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY depences
    ADD CONSTRAINT depences_pkey PRIMARY KEY (id_dep);


--
-- Name: employer_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY employer
    ADD CONSTRAINT employer_pkey PRIMARY KEY (id_em);


--
-- Name: epaiement_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY epaiement
    ADD CONSTRAINT epaiement_pkey PRIMARY KEY (id_ep);


--
-- Name: exercices_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY exercices
    ADD CONSTRAINT exercices_pkey PRIMARY KEY (annee, id_bo);


--
-- Name: facpaiement_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY facpaiement
    ADD CONSTRAINT facpaiement_pkey PRIMARY KEY (id_facp);


--
-- Name: facture_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY facture
    ADD CONSTRAINT facture_pkey PRIMARY KEY (id_fac);


--
-- Name: fournisseur_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY fournisseur
    ADD CONSTRAINT fournisseur_pkey PRIMARY KEY (id_fo);


--
-- Name: fpaiement_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY fpaiement
    ADD CONSTRAINT fpaiement_pkey PRIMARY KEY (id_fp);


--
-- Name: gdepenses_annee_key; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY gdepenses
    ADD CONSTRAINT gdepenses_annee_key UNIQUE (annee, mois, id_bo);


--
-- Name: produits_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY produits
    ADD CONSTRAINT produits_pkey PRIMARY KEY (id_pr);


--
-- Name: tepaiement_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY tepaiement
    ADD CONSTRAINT tepaiement_pkey PRIMARY KEY (id_tep);


--
-- Name: transferts_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY transferts
    ADD CONSTRAINT transferts_pkey PRIMARY KEY (id_tr);


--
-- Name: utilisateurs_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY utilisateurs
    ADD CONSTRAINT utilisateurs_pkey PRIMARY KEY (id_user);


--
-- Name: ventes_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY ventes
    ADD CONSTRAINT ventes_pkey PRIMARY KEY (id_ve);


--
-- Name: villes_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY villes
    ADD CONSTRAINT villes_pkey PRIMARY KEY (id_vi);


--
-- Name: vpaiement_pkey; Type: CONSTRAINT; Schema: public; Owner: imidsac; Tablespace: 
--

ALTER TABLE ONLY vpaiement
    ADD CONSTRAINT vpaiement_pkey PRIMARY KEY (id_vp);


--
-- Name: t_after_delete_employe; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_delete_employe AFTER DELETE ON employer FOR EACH ROW EXECUTE PROCEDURE f_after_delete_employe();


--
-- Name: t_after_delete_epaiement; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_delete_epaiement AFTER DELETE ON epaiement FOR EACH ROW EXECUTE PROCEDURE f_after_delete_epaiement();


--
-- Name: t_after_insert_employe; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_employe AFTER INSERT ON employer FOR EACH ROW EXECUTE PROCEDURE f_after_inser_employe();


--
-- Name: t_after_insert_update_del_achat_con; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_update_del_achat_con AFTER INSERT OR DELETE OR UPDATE ON achat_con FOR EACH ROW EXECUTE PROCEDURE f_after_insert_update_dele_achat_con();


--
-- Name: t_after_insert_update_del_cco; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_update_del_cco AFTER INSERT OR DELETE OR UPDATE ON ccommandes FOR EACH ROW EXECUTE PROCEDURE f_after_insert_update_dele_cco();


--
-- Name: t_after_insert_update_del_cfac; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_update_del_cfac AFTER INSERT OR DELETE OR UPDATE ON facture_con FOR EACH ROW EXECUTE PROCEDURE f_after_insert_update_dele_cfac();


--
-- Name: t_after_insert_update_del_depence; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_update_del_depence AFTER INSERT OR DELETE OR UPDATE ON depences FOR EACH ROW EXECUTE PROCEDURE f_after_insert_update_dele_depence();


--
-- Name: t_after_insert_update_del_ventes_con; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_update_del_ventes_con AFTER INSERT OR DELETE OR UPDATE ON ventes_con FOR EACH ROW EXECUTE PROCEDURE f_after_insert_update_dele_ventes_con();


--
-- Name: t_after_insert_update_delete_boutiques; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_update_delete_boutiques AFTER INSERT OR DELETE OR UPDATE ON boutiques FOR EACH ROW EXECUTE PROCEDURE f_after_insert_update_delete_boutiques();


--
-- Name: t_after_insert_update_delete_garticles; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_update_delete_garticles AFTER INSERT OR DELETE OR UPDATE ON articles FOR EACH ROW EXECUTE PROCEDURE f_after_insert_update_delete_garticles();


--
-- Name: t_after_insert_verait; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_insert_verait AFTER INSERT ON verait FOR EACH ROW EXECUTE PROCEDURE f_after_insert_verait();


--
-- Name: t_after_update_cfac; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_cfac AFTER UPDATE ON facture_con FOR EACH ROW EXECUTE PROCEDURE f_after_update_cfac();

ALTER TABLE facture_con DISABLE TRIGGER t_after_update_cfac;


--
-- Name: t_after_update_delete_achat; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_delete_achat AFTER DELETE OR UPDATE ON achat FOR EACH ROW EXECUTE PROCEDURE f_after_update_delete_achat();


--
-- Name: t_after_update_delete_commande; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_delete_commande AFTER DELETE OR UPDATE ON commandes FOR EACH ROW EXECUTE PROCEDURE f_after_update_delete_commande();


--
-- Name: t_after_update_delete_facture; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_delete_facture AFTER DELETE OR UPDATE ON facture FOR EACH ROW EXECUTE PROCEDURE f_after_update_delete_facture();


--
-- Name: t_after_update_delete_vente; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_delete_vente AFTER DELETE OR UPDATE ON ventes FOR EACH ROW EXECUTE PROCEDURE f_after_update_delete_vente();


--
-- Name: t_after_update_depence; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_depence AFTER UPDATE ON depences FOR EACH ROW EXECUTE PROCEDURE f_after_update_depences();

ALTER TABLE depences DISABLE TRIGGER t_after_update_depence;


--
-- Name: t_after_update_em; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_em AFTER UPDATE ON employer FOR EACH ROW EXECUTE PROCEDURE f_after_update_em();


--
-- Name: t_after_update_epaiement; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_after_update_epaiement AFTER UPDATE ON epaiement FOR EACH ROW EXECUTE PROCEDURE f_after_update_epaiement();


--
-- Name: t_befor_inser_cfac; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_inser_cfac BEFORE INSERT OR UPDATE ON facture_con FOR EACH ROW EXECUTE PROCEDURE f_befor_inser_update_cfac();

ALTER TABLE facture_con DISABLE TRIGGER t_befor_inser_cfac;


--
-- Name: t_befor_inser_update_cco; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_inser_update_cco BEFORE INSERT OR UPDATE ON ccommandes FOR EACH ROW EXECUTE PROCEDURE f_befor_inser_update_cco();


--
-- Name: t_befor_inser_update_vente_con; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_inser_update_vente_con BEFORE INSERT OR UPDATE ON ventes_con FOR EACH ROW EXECUTE PROCEDURE f_befor_inser_update_ventes_con();


--
-- Name: t_befor_insert_update_delete_achat_con; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_insert_update_delete_achat_con BEFORE INSERT OR DELETE OR UPDATE ON achat_con FOR EACH ROW EXECUTE PROCEDURE f_befor_inser_update_achat_con();


--
-- Name: t_befor_insert_update_delete_cfac; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_insert_update_delete_cfac BEFORE INSERT OR DELETE OR UPDATE ON facture_con FOR EACH ROW EXECUTE PROCEDURE f_befor_insert_update_delete_cfac();


--
-- Name: t_befor_insert_verait; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_insert_verait BEFORE INSERT ON verait FOR EACH ROW EXECUTE PROCEDURE f_befor_insert_verait();


--
-- Name: t_befor_update_achat; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_update_achat BEFORE UPDATE ON achat FOR EACH ROW EXECUTE PROCEDURE f_befor_update_achat();


--
-- Name: t_befor_update_cfac; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_update_cfac BEFORE UPDATE ON facture_con FOR EACH ROW EXECUTE PROCEDURE f_befor_update_cfac();

ALTER TABLE facture_con DISABLE TRIGGER t_befor_update_cfac;


--
-- Name: t_befor_update_cfac1; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_update_cfac1 BEFORE UPDATE ON facture_con FOR EACH ROW EXECUTE PROCEDURE f_befor_update_cfac1();

ALTER TABLE facture_con DISABLE TRIGGER t_befor_update_cfac1;


--
-- Name: t_befor_update_commandes; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_update_commandes BEFORE UPDATE ON commandes FOR EACH ROW EXECUTE PROCEDURE f_befor_update_commandes();


--
-- Name: t_befor_update_facture; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_update_facture BEFORE UPDATE ON facture FOR EACH ROW EXECUTE PROCEDURE f_befor_update_facture();


--
-- Name: t_befor_update_ventes; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_befor_update_ventes BEFORE UPDATE ON ventes FOR EACH ROW EXECUTE PROCEDURE f_befor_update_ventes();


--
-- Name: t_before_insert_boutiques; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_before_insert_boutiques BEFORE INSERT ON boutiques FOR EACH ROW EXECUTE PROCEDURE f_before_insert_boutiques();


--
-- Name: t_insert_after_depence; Type: TRIGGER; Schema: public; Owner: imidsac
--

CREATE TRIGGER t_insert_after_depence AFTER INSERT ON depences FOR EACH ROW EXECUTE PROCEDURE f_after_insert_depence();

ALTER TABLE depences DISABLE TRIGGER t_insert_after_depence;


--
-- Name: achat_con_id_ac_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY achat_con
    ADD CONSTRAINT achat_con_id_ac_fkey FOREIGN KEY (id_ac) REFERENCES achat(id_ac) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: achat_con_id_ar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY achat_con
    ADD CONSTRAINT achat_con_id_ar_fkey FOREIGN KEY (id_ar) REFERENCES articles(id_ar) ON UPDATE CASCADE;


--
-- Name: achat_id_fo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY achat
    ADD CONSTRAINT achat_id_fo_fkey FOREIGN KEY (id_fo) REFERENCES fournisseur(id_fo) ON UPDATE CASCADE;


--
-- Name: ccommandes_id_ar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY ccommandes
    ADD CONSTRAINT ccommandes_id_ar_fkey FOREIGN KEY (id_ar) REFERENCES articles(id_ar) ON UPDATE CASCADE;


--
-- Name: ccommandes_id_co_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY ccommandes
    ADD CONSTRAINT ccommandes_id_co_fkey FOREIGN KEY (id_co) REFERENCES commandes(id_co) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: commandes_id_cl_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY commandes
    ADD CONSTRAINT commandes_id_cl_fkey FOREIGN KEY (id_cl) REFERENCES clients(id_cl);


--
-- Name: facture_con_id_fac_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY facture_con
    ADD CONSTRAINT facture_con_id_fac_fkey FOREIGN KEY (id_fac) REFERENCES facture(id_fac) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ventes_con_id_ar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY ventes_con
    ADD CONSTRAINT ventes_con_id_ar_fkey FOREIGN KEY (id_ar) REFERENCES articles(id_ar) ON UPDATE CASCADE;


--
-- Name: ventes_con_id_ve_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY ventes_con
    ADD CONSTRAINT ventes_con_id_ve_fkey FOREIGN KEY (id_ve) REFERENCES ventes(id_ve) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: verait_id_b_fkey; Type: FK CONSTRAINT; Schema: public; Owner: imidsac
--

ALTER TABLE ONLY verait
    ADD CONSTRAINT verait_id_b_fkey FOREIGN KEY (id_b) REFERENCES bamk(id_b);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--


