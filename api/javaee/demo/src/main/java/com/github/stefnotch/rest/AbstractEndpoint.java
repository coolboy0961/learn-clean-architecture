package com.github.stefnotch.rest;

import com.github.stefnotch.business.AbstractDao;

import javax.ejb.Stateless;
import javax.inject.Inject;
import javax.persistence.PersistenceException;
import javax.ws.rs.*;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;


@Produces({MediaType.APPLICATION_JSON})
@Consumes({MediaType.APPLICATION_JSON})
@Stateless
public abstract class AbstractEndpoint<T, U extends AbstractDao<T>> {
    @Inject
    protected U dao;

    public AbstractEndpoint() {
    }

    @GET
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public Response getAll() {
        return Response.ok().entity(dao.findAll()).build();
    }

    @GET
    @Path("{id}")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public Response getSingle(@PathParam("id") long id) {
        T single = dao.find(id);
        if(single != null) {
            return Response.ok().entity(single).build();
        } else {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
    }

    @POST
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public Response post(T entity) {
        try {
            dao.insert(entity);
            dao.flushAndRefresh(entity);
        } catch(PersistenceException e) {
            return Response.status(Response.Status.BAD_REQUEST).build();
        }

        // Return the newly created entity
        return Response.ok(entity).build();
    }

    @PUT
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public Response put(T entity) {
        try {
            //Ideally it would check if the entity already exists
            // (dao.find(entity))
            // And if it doesn't, it should return 201 (CREATED) instead of 200 (OK)

            entity = dao.update(entity);
            dao.flushAndRefresh(entity);
        } catch (PersistenceException e) {
            return Response.status(Response.Status.BAD_REQUEST).build();
        }

        return Response.ok().build();
    }

    @DELETE
    @Path("{id}")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public Response delete(@PathParam("id") long id) {
        dao.delete(id);

        return Response.noContent().build();
    }
}
