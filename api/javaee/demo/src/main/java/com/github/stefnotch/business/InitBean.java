package com.github.stefnotch.business;

import javax.annotation.PostConstruct;
import javax.ejb.Singleton;
import javax.ejb.Startup;
import javax.enterprise.context.ApplicationScoped;
import javax.enterprise.context.Initialized;
import javax.enterprise.event.Observes;
import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;
import java.time.LocalDate;

// Old way?
//@Startup
//@Singleton

@ApplicationScoped
public class InitBean {
    //@PersistenceContext
    //EntityManager em;

    //@Inject your DAOs here

    public InitBean() {

    }

    private void init(@Observes @Initialized(ApplicationScoped.class) Object ini) {
        // init code
    }

    // Old way?
    /*@PostConstruct
    private void init() {
        
    }*/
}
