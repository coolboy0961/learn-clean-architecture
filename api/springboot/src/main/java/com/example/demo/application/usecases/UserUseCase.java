package com.example.demo.application.usecases;

import org.springframework.stereotype.Service;

import com.example.demo.application.UserRepository;
import com.example.demo.domain.model.User;

@Service
public class UserUseCase {

  private final UserRepository userRepository;

  public UserUseCase(UserRepository userRepository) {
    this.userRepository = userRepository;
  }

  public User createUser(User user) {
    User savedUser = userRepository.save(user);
    return savedUser;
  }
}
