package com.example.demo.application;

import java.util.Optional;

import com.example.demo.domain.model.User;

public interface UserRepository {
    User save(User user);
    User findById(Long id);
}