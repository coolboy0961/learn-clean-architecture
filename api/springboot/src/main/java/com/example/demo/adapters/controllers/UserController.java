package com.example.demo.adapters.controllers;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.adapters.controllers.requests.CreateUserRequest;
import com.example.demo.adapters.controllers.responses.UserResponse;
import com.example.demo.application.usecases.UserUseCase;
import com.example.demo.domain.model.User;

@RestController
@RequestMapping("/api/v1/users")
public class UserController {

  private final UserUseCase userUseCase;

  public UserController(UserUseCase userUseCase) {
    this.userUseCase = userUseCase;
  }

  @PostMapping
  public ResponseEntity<UserResponse> createUser(@RequestBody CreateUserRequest request) {
    User user = new User(request.getName(), request.getEmail());
    User createdUser = userUseCase.createUser(user);
    UserResponse response = new UserResponse(createdUser.getName(), createdUser.getEmail());
    return new ResponseEntity<>(response, HttpStatus.CREATED);
  }
}
