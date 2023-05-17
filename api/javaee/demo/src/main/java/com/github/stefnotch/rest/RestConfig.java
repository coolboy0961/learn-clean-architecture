package com.github.stefnotch.rest;

import javax.ws.rs.ApplicationPath;
import javax.ws.rs.core.Application;

@ApplicationPath("api")
public class RestConfig extends Application { //NOTE TO SELF: extends Application is important & easy to forget
}
