import { TestBed } from '@angular/core/testing';

import { ModulestateService } from './modulestate.service';

describe('ModulestateService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ModulestateService = TestBed.get(ModulestateService);
    expect(service).toBeTruthy();
  });
});
