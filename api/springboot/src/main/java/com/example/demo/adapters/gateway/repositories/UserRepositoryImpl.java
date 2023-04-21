package com.example.demo.adapters.gateway.repositories;

import java.util.Optional;

import org.springframework.stereotype.Repository;

import com.example.demo.application.UserRepository;
import com.example.demo.domain.model.User;
import com.example.demo.infrastructure.db.jpa.entities.UserJpaEntity;
import com.example.demo.infrastructure.db.jpa.repositories.UserJpaRepository;

@Repository
public class UserRepositoryImpl implements UserRepository {

  private final UserJpaRepository userJpaRepository;

  public UserRepositoryImpl(UserJpaRepository userJpaRepository) {
    this.userJpaRepository = userJpaRepository;
  }

  @Override
  public User save(User user) {
    UserJpaEntity userJpaEntity = new UserJpaEntity();
    userJpaEntity.setName(user.getName());
    userJpaEntity.setEmail(user.getEmail());
    userJpaRepository.save(userJpaEntity);
    return user;
  }

  @Override
  public User findById(Long id) {
    Optional<UserJpaEntity> userJpaEntityOption = userJpaRepository.findById(id);
    if (userJpaEntityOption.isPresent()) {
      UserJpaEntity entity = userJpaEntityOption.get();
      User user = new User(entity.getName(), entity.getEmail());
      return user;
    }
    return null;
  }
}
