package com.example.demo.adapters.controllers.requests;

import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class CreateUserRequest {
  private String name;
  private String email;
}
